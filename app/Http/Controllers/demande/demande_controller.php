<?php

namespace App\Http\Controllers\demande;

use App\Http\Controllers\Controller;

use App\Http\Requests\demande\demande_request;
use App\Models\Demande;
use App\Models\Commande;
use App\Models\StockMateriel;
use App\Models\StockConsommable;
use App\Models\DemandeMateriel;
use App\Models\DemandeConsommable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class demande_controller extends Controller
{
    public function index(Request $request)
    {
        $query = Demande::with(['demandeMateriels', 'demandeConsommables', 'user.departement']);

         // Récupérer l'utilisateur connecté et son rôle
         $user = auth()->user();
         $userRole = $user->role->intitule;
 
         if ($userRole !== 'Logisticien') {
             $query->where('id_user', $user->id);
         }
 
   
         if ($request->has('department_id') && $request->department_id !== 'all') {
             $query->whereHas('user.departement', function($q) use ($request) {
                 $q->where('id', $request->department_id);
             });
         }
 
        // Recherche si spécifiée
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%");
                })
                ->orWhereHas('user.departement', function($q) use ($search) {
                    $q->where('nom_departement', 'like', "%{$search}%");
                });
            });
        }

        $query->orderByRaw("CASE 
            WHEN urgence = 'haute' THEN 1
            WHEN urgence = 'moyenne' THEN 2
            WHEN urgence = 'basse' THEN 3
            ELSE 4
        END")
        ->orderBy('created_at', 'desc');

        
        $perPage = $request->input('per_page', 15);
        $demandes = $query->paginate($perPage);
        
        return response()->json([
            'statut' => $demandes->isEmpty() ? 404 : 200,
            'demandes' => $demandes
        ]);
    }

    public function getDemandesACommander(Request $request)
    {
        try {
            Log::info('Début getDemandesACommander');
            
            $query = Demande::with([
                'demandeMateriels' => function($query) {
                    $query->where('a_commander', 1)
                          ->with('stockMateriel');
                },
                'demandeConsommables' => function($query) {
                    $query->where('a_commander', 1)
                          ->with('stockConsommable');
                },
                'user.departement'
            ])
            ->where('statut', 'validé')
            ->where(function($q) {
                $q->whereHas('demandeMateriels', function($q) {
                    $q->where('a_commander', 1);
                })
                ->orWhereHas('demandeConsommables', function($q) {
                    $q->where('a_commander', 1);
                });
            });

            // Pagination
            $perPage = $request->input('per_page', 100);
            $demandes = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'statut' => $demandes->isEmpty() ? 404 : 200,
                'demandes' => $demandes
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des demandes à commander:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des demandes à commander'
            ], 500);
        }
    }

    public function validerDemande($id)
    {
        try {
            Log::info("Début de la validation de la demande ID: " . $id);
            DB::beginTransaction();

            $demande = Demande::with(['demandeMateriels', 'demandeConsommables'])->findOrFail($id);
            Log::info("Demande trouvée:", ['demande' => $demande->toArray()]);
            
            // Mettre à jour le statut de la demande
            $demande->statut = Demande::STATUT_VALIDE;
            $demande->save();
            Log::info("Statut de la demande mis à jour à 'validé'");

            // Vérifier la disponibilité du stock
            Log::info("Vérification de la disponibilité du stock...");
            $stockController = new \App\Http\Controllers\Stock\StockController();
            $verificationResponse = $stockController->verifierDisponibilite($id);
            
            Log::info("Résultat de la vérification:", [
                'status_code' => $verificationResponse->getStatusCode(),
                'content' => json_decode($verificationResponse->getContent(), true)
            ]);
            
            if ($verificationResponse->getStatusCode() !== 200) {
                throw new \Exception('Erreur lors de la vérification de la disponibilité');
            }

            // Recharger la demande pour avoir le checking_status à jour
            $demande->refresh();
            Log::info("Demande rechargée, nouveau checking status: " . $demande->checking_status);

            // Si des éléments sont disponibles en stock, les dispatcher
            if ($demande->checking_status === Demande::CHECKING_DISPONIBLE || 
                $demande->checking_status === Demande::CHECKING_PARTIELLEMENT_DISPONIBLE) {
                Log::info("Début du dispatch du stock...");
                $dispatchResponse = $stockController->dispatcherStock($id);
                
                Log::info("Résultat du dispatch:", [
                    'status_code' => $dispatchResponse->getStatusCode(),
                    'content' => json_decode($dispatchResponse->getContent(), true)
                ]);
                
                if ($dispatchResponse->getStatusCode() !== 200) {
                    throw new \Exception('Erreur lors du dispatch du stock');
                }
            } else {
                Log::info("Pas de dispatch nécessaire - stock non disponible");
            }

            DB::commit();
            Log::info("Validation de la demande terminée avec succès");

            return response()->json([
                'statut' => 200,
                'message' => 'Demande validée avec succès',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur dans validerDemande: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la validation de la demande: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateUrgence(Request $request, $id)
    {
        try {
            $request->validate([
                'urgence' => 'required|in:basse,moyenne,haute'
            ]);
    
            $demande = Demande::find($id);
            if (!$demande) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Demande non trouvée'
                ], 404);
            }
    
            $demande->urgence = $request->urgence;
            $demande->save();
    
            return response()->json([
                'statut' => 200,
                'message' => 'Urgence mise à jour avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur dans updateUrgence: " . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la mise à jour de l\'urgence'
            ], 500);
        }
    }
    public function store(demande_request $request) {
        try {
            DB::beginTransaction();
            
            // Créer la demande avec une valeur par défaut pour urgence
            $demande = Demande::create([
                'type_demande' => $request->type_demande,
                'id_user' => Auth::id(),
                'statut' => Demande::STATUT_EN_ATTENTE,
                'checking_status' => Demande::CHECKING_NON_VERIFIE,
                'observations' => $request->observations,
                'urgence' => $request->urgence ?? Demande::URGENCE_MOYENNE,
            ]);

            // Log des données reçues
            Log::info("Données reçues dans store:", [
                'all' => $request->all(),
                'type_demande' => $request->type_demande,
                'materiels' => $request->materiels,
                'consommables' => $request->consommables
            ]);

            $data = $request->validated();
            Log::info("Données validées:", $data);

            // Gérer les matériels si présents et non vides
            if (($request->type_demande == 'materiel' || $request->type_demande == 'both') && 
                isset($request->materiels) && is_array($request->materiels) && !empty($request->materiels)) {
                
                Log::info("Traitement des matériels:", ['materiels' => $request->materiels]);
                
                foreach ($request->materiels as $materiel) {
                    if (!empty($materiel['libelle']) && !empty($materiel['quantite'])) {
                        DemandeMateriel::create([
                            'id_demande' => $demande->id,
                            'libelle' => $materiel['libelle'],
                            'quantite' => intval($materiel['quantite']),
                            'description' => $materiel['description'] ?? '',
                            'a_commander' => false, // Par défaut à false, sera déterminé lors de la validation
                            'besoin_commande' => true
                        ]);
                    }
                }
            }

            // Gérer les consommables si présents et non vides
            if (($request->type_demande == 'consommable' || $request->type_demande == 'both') && 
                isset($request->consommables) && is_array($request->consommables) && !empty($request->consommables)) {
                
                foreach ($request->consommables as $consommable) {
                    if (!empty($consommable['libelle']) && !empty($consommable['quantite'])) {
                        DemandeConsommable::create([
                            'id_demande' => $demande->id,
                            'libelle' => $consommable['libelle'],
                            'quantite' => intval($consommable['quantite']),
                            'description' => $consommable['description'] ?? '',
                            'a_commander' => false, // Par défaut à false, sera déterminé lors de la validation
                            'besoin_commande' => true
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'statut' => 200,
                'message' => 'Demande créée avec succès',
                'demande' => $demande
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Erreur dans store: " . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la création de la demande'
            ], 500);
        }
    }

    public function update(demande_request $request, $id) {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }

        $data = $request->validated();
        $demande->update($data);

        if ($request->type_demande == 'materiel' || $request->type_demande == 'both') {
            $demande->demandeMateriels()->delete();
            foreach ($request->materiels as $materiel) {
                DemandeMateriel::create([
                    'id_demande' => $demande->id,
                    'libelle' => $materiel['libelle'],
                    'quantite' => $materiel['quantite'],
                    'description' => $materiel['description'],
                ]);
            }
        }

        if ($request->type_demande == 'consommable' || $request->type_demande == 'both') {
            $demande->demandeConsommables()->delete();
            foreach ($request->consommables as $consommable) {
                DemandeConsommable::create([
                    'id_demande' => $demande->id,
                    'libelle' => $consommable['libelle'],
                    'quantite' => $consommable['quantite'],
                    'description' => $consommable['description'],
                ]);
            }
        }

        return response()->json([
            'statut' => 200,
            'message' => 'Mise à jour effectuée avec succès',
        ]);
    }

    public function destroy($id) {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }

        $demande->delete();
        return response()->json(['statut' => 200, 'message' => 'Demande supprimée avec succès']);
    }

    public function show($id) {
        try {
            $demande = Demande::with([
                'demandeMateriels',
                'demandeConsommables',
                'user',
                'user.departement'
            ])->find($id);

            if (!$demande) {
                return response()->json([
                    'statut' => 404, 
                    'message' => 'Demande non trouvée'
                ], 404);
            }

            Log::info("Données de la demande:", ['demande' => $demande->toArray()]);

            return response()->json([
                'statut' => 200,
                'demande' => $demande
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur dans show: " . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération de la demande: ' . $e->getMessage()
            ], 500);
        }
    }

    public function changeStatut(Request $request, $id) {
        try {
            Log::info("Méthode changeStatut appelée avec ID: {$id}");
    
            $demande = Demande::find($id);
            if (!$demande) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Demande non trouvée'
                ], 404);
            }
    
            // Valider le statut et les observations
            $request->validate([
                'statut' => 'required|in:"en_attente","validé","en_cours","reçu","rejete","traitée"',
                'observations' => 'nullable|string|max:500'
            ]);
    
            // Mettre à jour le statut et les observations de la demande
            $demande->update([
                'statut' => $request->input('statut'),
                'observations' => $request->input('observations')
            ]);
    
            // Si le statut est "validé", appeler la méthode de validation
            if ($request->input('statut') === 'validé') {
                return $this->validerDemande($id);
            }

            return response()->json([
                'statut' => 200,
                'message' => 'Statut et observations mis à jour avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur dans changeStatut: " . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur interne du serveur: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function userDemandes() {
        $userId = Auth::id();
        $demandes = Demande::where('id_user', $userId)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'statut' => $demandes->count() > 0 ? 200 : 500,
            'demandes' => $demandes->count() > 0 ? $demandes : null,
            'message' => $demandes->count() > 0 ? null : 'Aucune donnée trouvée',
        ]);
    }

    public function getLastThreeDemandes() {
        $demandes = Demande::orderBy('created_at', 'desc')->take(3)->get();
        if ($demandes->isNotEmpty()) {
            return response()->json([
                'statut' => 200,
                'demandes' => $demandes
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function indexpagine(Request $request)
    {
        $query = Demande::with(['demandeMateriels', 'demandeConsommables', 'user.departement'])
            ->where('statut', 'validé')
            ->whereIn('checking_status', ['partiellement_disponible', 'non_disponible'])
            ->orderBy('created_at', 'desc');

        $demandes = $query->get()->map(function ($demande) {
            // Filtrer les matériels et consommables qui ont besoin d'être commandés
            $materielsFiltres = $demande->demandeMateriels->filter(function ($materiel) {
                return $materiel->a_commander;
            });
            
            $consommablesFiltres = $demande->demandeConsommables->filter(function ($consommable) {
                return $consommable->a_commander;
            });

            // Ne garder que les demandes qui ont au moins un article à commander
            if ($materielsFiltres->isEmpty() && $consommablesFiltres->isEmpty()) {
                return null;
            }

            // Créer une copie de la demande avec seulement les articles à commander
            $demandeFiltree = new Demande();
            $demandeFiltree->id = $demande->id;
            $demandeFiltree->statut = $demande->statut;
            $demandeFiltree->checking_status = $demande->checking_status;
            $demandeFiltree->created_at = $demande->created_at;
            $demandeFiltree->updated_at = $demande->updated_at;
            $demandeFiltree->setRelation('demandeMateriels', $materielsFiltres);
            $demandeFiltree->setRelation('demandeConsommables', $consommablesFiltres);
            $demandeFiltree->setRelation('user', $demande->user);

            return $demandeFiltree;
        })->filter()->values();

        return response()->json([
            'statut' => $demandes->isNotEmpty() ? 200 : 404,
            'demandes' => [
                'current_page' => 1,
                'data' => $demandes,
                'first_page_url' => '',
                'from' => 1,
                'last_page' => 1,
                'last_page_url' => '',
                'next_page_url' => null,
                'path' => '',
                'per_page' => $request->input('per_page', 15),
                'prev_page_url' => null,
                'to' => $demandes->count(),
                'total' => $demandes->count()
            ]
        ]);
    }
}