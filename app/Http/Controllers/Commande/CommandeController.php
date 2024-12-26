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
                $idDemandes = json_decode($commande->id_demande ?? '[]', true);
                
                // S'assurer que $idDemandes est un tableau
                if (!is_array($idDemandes)) {
                    $idDemandes = [];
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
    

   /* public function show($id)
    {
        $commande = Commande::with([
            'demande.user.departement',
            'demande.materiels',    // Relation avec DemandeMateriel
            'demande.consommables', // Relation avec DemandeConsommable
            'fournisseur'
        ])->find($id);
    
        if (!$commande) {
            return response()->json([
                'statut' => 404,
                'message' => 'Commande non trouvée'
            ], 404);
        }
    
        return response()->json([
            'statut' => 200,
            'commande' => $commande
        ]);
    }*/
    public function show($id)
    {
        try {
            $commande = Commande::find($id);
    
            if (!$commande) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Commande non trouvée'
                ], 404);
            }
    
            $demandeIds = is_string($commande->id_demande) 
                ? json_decode($commande->id_demande, true) 
                : $commande->id_demande;
    
            $demandes = Demande::whereIn('id', $demandeIds ?? [])
                ->with([
                    'user.departement',
                    'materiels',
                    'consommables'
                ])
                ->get();
    
            return response()->json([
                'statut' => 200,
                'commande' => $commande,
                'demandes' => $demandes
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur dans show(): ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des détails',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CommandeRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            $demandeIds = is_array($validatedData['id_demande']) 
                ? $validatedData['id_demande'] 
                : json_decode($validatedData['id_demande']);
    
            Log::info('Demandes reçues:', ['ids' => $demandeIds]);
            
            if (empty($demandeIds)) {
                return response()->json([
                    'statut' => 400,
                    'message' => 'Aucune demande fournie'
                ], 400);
            }
    
            $demandes = Demande::whereIn('id', $demandeIds)
                              ->where('statut', 'validé')
                              ->get();
    
            if ($demandes->isEmpty()) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Aucune demande validée trouvée'
                ], 404);
            }
    
            $validatedDemandeIds = $demandes->pluck('id')->toArray();
            $reference = 'CMD' . date('dmY') . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    
            $commande = Commande::create([
                'reference_commande' => $reference,
                'id_demande' => json_encode($validatedDemandeIds),
                'date_commande' => now(),
                'statut' => $validatedData['statut']
            ]);
    
            Demande::whereIn('id', $validatedDemandeIds)
                   ->update(['statut' => 'en_cours']);
                   return response()->json([
                    'statut' => 200,
                    'message' => 'Commande créée avec succès',
                    'commande' => $commande
                ], 200);
        
            } catch (\Exception $e) {
                Log::error('Erreur lors de la création de la commande: ' . $e->getMessage());
                return response()->json([
                    'statut' => 500,
                    'message' => 'Erreur lors de la création de la commande: ' . $e->getMessage(),
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