<?php

namespace App\Http\Controllers\demande;

use App\Http\Controllers\Controller;
use App\Http\Requests\demande\demande_request;
use App\Models\Demande;
use App\Models\Commande;
use App\Models\StockMateriel;
use App\Models\DemandeMateriel;
use App\Models\DemandeConsommable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class demande_controller extends Controller
{
    public function index(Request $request) {
        $userId = Auth::id();
        $userRole = Auth::user()->role->intitule;
        $departmentId = $request->input('department_id');
        
        $perPage = $request->has('per_page') ? $request->per_page : 15;
        
        // Ajout des relations materiels et consommables
        $query = Demande::with([
            'user.departement',
            'materiels',   
            'consommables'  
        ]);
        $query->orderBy('urgence', 'desc')
              ->orderBy('created_at', 'desc');
  
        if ($userRole === 'Logisticien') {
            if ($departmentId && $departmentId !== 'all') {
                $query->whereHas('user.departement', function($q) use ($departmentId) {
                    $q->where('id', $departmentId);
                });
            }
        } else {
            $query->where('id_user', $userId);
        }
        
        $demandes = $query->paginate($perPage);
        
        return response()->json([
            'statut' => $demandes->isNotEmpty() ? 200 : 500,
            'demandes' => $demandes->isNotEmpty() ? $demandes : null,
            'message' => $demandes->isNotEmpty() ? null : 'Aucune donnée trouvée',
        ]);
    }

    public function validerDemande($id)
    {
        $demande = Demande::with(['materiels', 'consommables'])->findOrFail($id);
        $materiels = $demande->materiels; // Récupérer les matériels associés à la demande

        // Vérifiez la disponibilité des matériels
        $disponibles = [];
        $nonDisponibles = [];

        foreach ($materiels as $materiel) {
            $stock = StockMateriel::where('id_type_materiel', $materiel->id_type_materiel)
                ->where('quantite_disponible', '>=', $materiel->quantite)
                ->first();

            if ($stock) {
                $disponibles[] = $stock;
            } else {
                $nonDisponibles[] = $materiel;
            }
        }

        // Si tous les matériels sont disponibles
        if (empty($nonDisponibles)) {
            // Distribuer les matériels disponibles
            foreach ($disponibles as $stock) {
                $stock->quantite_disponible -= $stock->quantite; // Réduire la quantité disponible
                $stock->save();
            }
            // Marquer la demande comme traitée
            $demande->statut = 'traitée';
            $demande->save();
        } else {
            // Créer une commande pour les matériels non disponibles
            $commande = Commande::create([
                'reference_commande' => 'REF-' . time(),
                'statut' => 'en attente',
                'id_demande' => json_encode($nonDisponibles), // Enregistrer les IDs des demandes non satisfaites
                // Autres champs nécessaires
            ]);

            // Associer la demande à la commande
            $demande->id_commande = $commande->id;
            $demande->save();

            // Logique pour passer la commande au fournisseur
            // ...
        }

        return response()->json([
            'statut' => 200,
            'message' => 'Demande validée avec succès',
        ]);
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
        $data = $request->validated();
        $data['id_user'] = Auth::id();
        $data['statut'] = 'en_attente';
        $data['urgence'] = $data['urgence'] ?? 'moyenne'; // Valeur par défaut

        $demande = Demande::create($data);

        if ($request->type_demande == 'materiel' || $request->type_demande == 'both') {
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
            'message' => 'Demande créée avec succès',
        ]);
    }

    public function update(demande_request $request, $id) {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }

        $data = $request->validated();
        $demande->update($data);

        if ($request->type_demande == 'materiel' || $request->type_demande == 'both') {
            $demande->materiels()->delete();
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
            $demande->consommables()->delete();
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
        $demande = Demande::with(['materiels', 'consommables', 'user.departement'])->find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }
        return response()->json([
            'statut' => 200,
            'demande' => $demande
        ]);
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
                'statut' => 'required|in:en_attente,validé,en_cours,reçu,rejete',
                'observations' => 'nullable|string|max:500'
            ]);
    
            // Mettre à jour le statut et les observations de la demande
            $demande->statut = $request->input('statut');
            $demande->observations = $request->input('observations');
            $demande->save();
    
            // Si le statut est "validé", appeler la méthode de validation
            if ($demande->statut === 'validé') {
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
                'message' => 'Erreur interne du serveur'
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

    public function indexpagine(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;
        $search = $request->has('search') ? $request->search : '';

        $demandes = Demande::where('type_demande', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->orderBy('created_at', 'desc')
                        ->paginate($perPage);

        return response()->json([
            'statut' => $demandes->isNotEmpty() ? 200 : 500,
            'demandes' => $demandes->isNotEmpty() ? $demandes : null,
            'message' => $demandes->isNotEmpty() ? null : 'Aucun enregistrement trouvé',
        ]);
    }
}