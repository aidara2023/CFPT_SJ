<?php

namespace App\Http\Controllers\demande;

use App\Http\Controllers\Controller;
use App\Http\Requests\demande\demande_request;
use App\Models\Demande;
use App\Models\DemandeMateriel;
use App\Models\DemandeConsommable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class demande_controller extends Controller
{
    public function index(Request $request) {
        $userId = Auth::id();
        $user = Auth::user();
        $userRole = $user->role->intitule;

        $perPage = $request->has('per_page') ? $request->per_page : 15;

        if ($userRole === 'Logisticien') {
            $demandes = Demande::with(['user', 'materiels', 'consommables'])
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            $demandes = Demande::with(['user', 'materiels', 'consommables'])
                ->where('id_user', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        }

        return response()->json($demandes);
    }

    public function store(demande_request $request) {
        $data = $request->validated();
        $data['id_user'] = Auth::id();
        $data['statut'] = 'en_attente';

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
        $demande = Demande::with(['materiels', 'consommables'])->find($id);
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
                Log::warning("Demande non trouvée pour l'ID: {$id}");
                return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
            }
    
            // Valider le statut
            $request->validate([
                'statut' => 'required|in:en_attente,en_cours,reçu,rejete'
            ]);
    
            // Mettre à jour le statut de la demande
            $demande->statut = $request->input('statut'); 
            $demande->save();
    
            Log::info("Statut mis à jour avec succès pour la demande ID: {$id}");
    
            return response()->json(['statut' => 200, 'message' => 'Statut mis à jour avec succès']);
        } catch (\Exception $e) {
            Log::error("Erreur dans changeStatut: " . $e->getMessage());
            return response()->json(['statut' => 500, 'message' => 'Erreur interne du serveur'], 500);
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

        if ($demandes != null) {
            return response()->json([
                'statut' => 200,
                'demandes' => $demandes
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement trouvé',
            ], 500);
        }
    }
}