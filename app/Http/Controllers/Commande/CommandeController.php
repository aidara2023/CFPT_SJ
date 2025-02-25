<?php

namespace App\Http\Controllers\Commande;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commande\CommandeRequest;
use App\Models\Commande;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
/**
 * @property int $id
 * @property string $reference_commande
 * @property array $id_demande
 * @property int $id_fournisseur
 * @property string $date_commande
 * @property string $statut
 * @property int $nombre_demandes
 */
class CommandeController extends Controller
{
    
    public function index()
    {
        try {
            $commandes = Commande::orderBy('created_at', 'desc')->get();
            
            $commandes = $commandes->map(function ($commande) {
                $idDemandes = [];
                
                // Gérer le cas où id_demande est déjà un array ou une string JSON
                if (!empty($commande->id_demande)) {
                    if (is_string($commande->id_demande)) {
                        $idDemandes = json_decode($commande->id_demande, true) ?? [];
                    } elseif (is_array($commande->id_demande)) {
                        $idDemandes = $commande->id_demande;
                    }
                }
                
                return [
                    'id' => $commande->id,
                    'reference_commande' => $commande->reference_commande,
                    'date_commande' => $commande->date_commande,
                    'statut' => $commande->statut,
                    'id_demande' => $idDemandes,
                    'nombre_demandes' => count($idDemandes)
                ];
            });
    
            return response()->json([
                'statut' => 200,
                'commandes' => $commandes
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur dans index(): ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des commandes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            Log::info("Début de la méthode show pour la commande ID: " . $id);
            
            $commande = Commande::find($id);
            Log::info("Commande trouvée:", ['commande' => $commande]);
    
            if (!$commande) {
                Log::warning("Commande non trouvée avec l'ID: " . $id);
                return response()->json([
                    'statut' => 404,
                    'message' => 'Commande non trouvée'
                ], 404);
            }
    
            // Extraire les IDs de demande
            $demandeIds = [];
            if (!empty($commande->id_demande)) {
                if (is_string($commande->id_demande)) {
                    $demandeIds = json_decode($commande->id_demande, true) ?? [];
                    Log::info("IDs de demande décodés depuis JSON:", ['ids' => $demandeIds]);
                } elseif (is_array($commande->id_demande)) {
                    $demandeIds = $commande->id_demande;
                    Log::info("IDs de demande depuis tableau:", ['ids' => $demandeIds]);
                }
            }
            
            // S'assurer que demandeIds est un tableau plat d'IDs uniques
            $demandeIds = array_unique(array_filter($demandeIds));
            Log::info("IDs de demande après nettoyage:", ['ids' => $demandeIds]);
    
            // Récupérer les demandes avec leurs relations
            Log::info("Récupération des demandes avec les relations");
            $demandes = Demande::whereIn('id', $demandeIds)
                ->with(['demandeMateriels' => function($query) {
                    $query->where('a_commander', 1)
                        ->with('stockMateriel');
                }, 'demandeConsommables' => function($query) {
                    $query->where('a_commander', 1)
                        ->with('stockConsommable');
                }, 'user.departement'])
                ->get();

            Log::info("Demandes récupérées:", ['count' => $demandes->count()]);
    
            // Transformer les demandes pour inclure les détails
            $demandes = $demandes->map(function ($demande) {
                Log::info("Traitement de la demande ID: " . $demande->id, [
                    'checking_status' => $demande->checking_status
                ]);
                
                // Traiter les matériels
                $materiels = $demande->demandeMateriels->map(function ($item) {
                    Log::info("Traitement du matériel:", [
                        'id' => $item->id,
                        'libelle' => $item->libelle,
                        'a_commander' => $item->a_commander,
                        'quantite' => $item->quantite,
                        'quantite_disponible' => $item->quantite_disponible
                    ]);
                    
                    return [
                        'id' => $item->id,
                        'libelle' => $item->libelle,
                        'quantite' => $item->quantite,
                        'description' => $item->description,
                        'a_commander' => true,
                        'materiel' => $item->stockMateriel
                    ];
                });
                
                Log::info("Matériels transformés:", ['count' => count($materiels)]);
                
                // Traiter les consommables
                $consommables = $demande->demandeConsommables->map(function ($item) {
                    Log::info("Traitement du consommable:", [
                        'id' => $item->id,
                        'libelle' => $item->libelle,
                        'a_commander' => $item->a_commander,
                        'quantite' => $item->quantite,
                        'quantite_disponible' => $item->quantite_disponible
                    ]);
                    
                    return [
                        'id' => $item->id,
                        'libelle' => $item->libelle,
                        'quantite' => $item->quantite,
                        'description' => $item->description,
                        'a_commander' => true,
                        'consommable' => $item->stockConsommable
                    ];
                });
                
                Log::info("Consommables transformés:", ['count' => count($consommables)]);

                // Retourner la demande avec les relations transformées
                return [
                    'id' => $demande->id,
                    'statut' => $demande->statut,
                    'checking_status' => $demande->checking_status,
                    'type_demande' => $demande->type_demande,
                    'observations' => $demande->observations,
                    'urgence' => $demande->urgence,
                    'created_at' => $demande->created_at,
                    'updated_at' => $demande->updated_at,
                    'user' => $demande->user,
                    'materiels' => $materiels,
                    'consommables' => $consommables
                ];
            });
    
            $response = [
                'statut' => 200,
                'commande' => [
                    'id' => $commande->id,
                    'reference_commande' => $commande->reference_commande,
                    'date_commande' => $commande->date_commande,
                    'statut' => $commande->statut,
                    'id_demande' => $demandeIds,
                    'nombre_demandes' => count($demandeIds)
                ],
                'demandes' => $demandes
            ];
            
            Log::info("Réponse finale préparée:", [
                'commande_id' => $commande->id,
                'nombre_demandes' => count($demandes),
                'demandes_avec_materiels' => collect($demandes)->pluck('materiels')->flatten()->count(),
                'demandes_avec_consommables' => collect($demandes)->pluck('consommables')->flatten()->count()
            ]);

            return response()->json($response);
            
        } catch (\Exception $e) {
            Log::error('Erreur dans show(): ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des détails',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDemandesACommander()
    {
        try {
            // Récupérer uniquement les demandes validées avec des items non disponibles
            $demandes = Demande::where('statut', Demande::STATUT_VALIDE)
                ->whereIn('checking_status', [
                    Demande::CHECKING_NON_DISPONIBLE,
                    Demande::CHECKING_PARTIELLEMENT_DISPONIBLE
                ])
                ->whereNull('id_commande')
                ->with(['materiels', 'consommables', 'user.departement'])
                ->get();

            $demandesFormatted = $demandes->map(function ($demande) {
                // Récupérer les items_non_disponibles depuis la base de données
                $itemsNonDisponibles = $demande->items_non_disponibles;
                
                return [
                    'id' => $demande->id,
                    'user' => $demande->user->nom . ' ' . $demande->user->prenom,
                    'departement' => $demande->user->departement->nom,
                    'date_demande' => $demande->created_at,
                    'checking_status' => $demande->checking_status,
                    // Pour les matériels, ne montrer que ceux qui sont dans items_non_disponibles
                    'materiels_a_commander' => isset($itemsNonDisponibles['materiels']) ? 
                        collect($itemsNonDisponibles['materiels'])->map(function ($item) {
                            return [
                                'libelle' => $item['libelle'],
                                'marque' => $item['marque'],
                                'quantite' => $item['quantite_demandee']
                            ];
                        })->values()->all() : [],
                    // Pour les consommables, ne montrer que ceux qui sont dans items_non_disponibles
                    'consommables_a_commander' => isset($itemsNonDisponibles['consommables']) ? 
                        collect($itemsNonDisponibles['consommables'])->map(function ($item) {
                            return [
                                'libelle' => $item['libelle'],
                                'quantite' => $item['quantite_demandee']
                            ];
                        })->values()->all() : []
                ];
            });

            return response()->json([
                'statut' => 200,
                'demandes' => $demandesFormatted
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des demandes à commander: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des demandes'
            ], 500);
        }
    }

    public function store(CommandeRequest $request)
    {
        try {
            $demandeIds = $request->id_demande;
            
            // Vérifier que toutes les demandes sont valides et ont besoin d'une commande
            $demandes = Demande::whereIn('id', $demandeIds)
                ->where('statut', Demande::STATUT_VALIDE)
                ->whereIn('checking_status', [
                    Demande::CHECKING_NON_DISPONIBLE,
                    Demande::CHECKING_PARTIELLEMENT_DISPONIBLE
                ])
                ->whereNull('id_commande')
                ->get();

            if ($demandes->count() !== count($demandeIds)) {
                return response()->json([
                    'statut' => 400,
                    'message' => 'Certaines demandes ne sont pas valides pour la commande'
                ], 400);
            }

            // Créer la commande
            $commande = Commande::create([
                'reference_commande' => 'CMD-' . time(),
                'date_commande' => now(),
                'statut' => 'envoyé',
                'id_demande' => json_encode($demandeIds)
            ]);

            // Mettre à jour les demandes
            foreach ($demandes as $demande) {
                $demande->update([
                    'statut' => Demande::STATUT_EN_COURS,
                    'id_commande' => $commande->id
                ]);
            }

            return response()->json([
                'statut' => 200,
                'message' => 'Commande créée avec succès',
                'commande' => $commande
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la commande: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la création de la commande'
            ], 500);
        }
    }

    public function update(CommandeRequest $request, $id)
    {
        try {
            $commande = Commande::find($id); // Retirez le with('demandes')

            if (!$commande) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Commande non trouvée'
                ], 404);
            }

            $validatedData = $request->validated();

            // Mise à jour de la commande
            $commande->update([
                'statut' => $validatedData['statut']
            ]);

            // Si la commande est marquée comme livrée
            if ($validatedData['statut'] === 'livré') {
                // Décoder les IDs des demandes si nécessaire
                $demandeIds = is_string($commande->id_demande) 
                    ? json_decode($commande->id_demande, true) 
                    : $commande->id_demande;

                if (!empty($demandeIds)) {
                    Demande::whereIn('id', $demandeIds)
                        ->update(['statut' => 'reçu']);

                    Log::info('Mise à jour des demandes', [
                        'commande_id' => $id,
                        'demandes' => $demandeIds
                    ]);
                }
            }

            return response()->json([
                'statut' => 200,
                'message' => 'Commande mise à jour avec succès',
                'commande' => $commande->fresh()
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de la commande: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la mise à jour de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $commande = Commande::find($id);

            if (!$commande) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Commande non trouvée'
                ], 404);
            }

            $commande->delete();

            return response()->json([
                'statut' => 200,
                'message' => 'Commande supprimée avec succès'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la commande: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la suppression de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}