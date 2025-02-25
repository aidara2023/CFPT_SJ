<?php

namespace App\Http\Controllers\dispatching;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Demande;
use App\Models\Materiel;
use App\Models\Consommable;
use App\Models\Dispatching;
use App\Models\Departement;
use App\Models\StockMateriel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class dispatching_controller extends Controller
{
    public function index()
    {
        try {
            // Récupérer les commandes livrées avec leurs relations
            $commandes = Commande::where('statut', 'livré')
                ->with([
                    'demandes.demandeMateriels.stockMateriel',
                    'demandes.demandeConsommables.stockConsommable'
                ])
                ->get()
                ->map(function ($commande) {
                    return [
                        'id' => $commande->id,
                        'reference_commande' => $commande->reference_commande,
                        'date_commande' => $commande->date_commande,
                        'statut' => $commande->statut,
                        'demandes' => $commande->demandes
                    ];
                });

            return response()->json([
                'statut' => 200,
                'commandes' => $commandes
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des commandes: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des commandes'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            Log::info("Début du chargement de la commande #" . $id);
            
            $commande = Commande::with([
                'demandes.demandeMateriels.stockMateriel.materiel',
                'demandes.demandeConsommables.stockConsommable.consommable'
            ])->findOrFail($id);

            Log::info("Commande chargée avec " . $commande->demandes->count() . " demandes");

            $demandes = $commande->demandes->map(function ($demande) {
                Log::info("Traitement de la demande #" . $demande->id);
                
                // Log des matériels
                $materiels = $demande->demandeMateriels;
                Log::info("Demande #" . $demande->id . " a " . $materiels->count() . " matériels");
                foreach ($materiels as $materiel) {
                    Log::info("Matériel #" . $materiel->id . " - a_commander: " . ($materiel->a_commander ? 'oui' : 'non'));
                }

                // Log des consommables
                $consommables = $demande->demandeConsommables;
                Log::info("Demande #" . $demande->id . " a " . $consommables->count() . " consommables");
                foreach ($consommables as $consommable) {
                    Log::info("Consommable #" . $consommable->id . " - a_commander: " . ($consommable->a_commander ? 'oui' : 'non'));
                }

                // Filtrer uniquement les items à commander
                $demande->demandeMateriels = $materiels->filter(function ($materiel) {
                    return $materiel->a_commander;
                });
                
                $demande->demandeConsommables = $consommables->filter(function ($consommable) {
                    return $consommable->a_commander;
                });

                Log::info("Après filtrage - Demande #" . $demande->id . " a " . 
                    $demande->demandeMateriels->count() . " matériels et " . 
                    $demande->demandeConsommables->count() . " consommables à commander");
                
                return $demande;
            })->filter(function ($demande) {
                return $demande->demandeMateriels->isNotEmpty() || $demande->demandeConsommables->isNotEmpty();
            })->values();

            Log::info("Nombre final de demandes avec items à commander : " . $demandes->count());

            return response()->json([
                'statut' => 200,
                'commande' => $commande,
                'demandes' => $demandes
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur dans dispatching.show: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des détails: ' . $e->getMessage()
            ], 500);
        }
    }

    public function dispatcher($id)
    {
        try {
            DB::beginTransaction();
            
            // Récupérer les données de la requête
            $batiment_id = request('batiment_id');
            $salle_id = request('salle_id');
            $item_id = request('item_id');
            $quantite = request('quantite');

            // Vérifier que les données requises sont présentes
            if (!$batiment_id || !$salle_id || !$item_id || !$quantite) {
                return response()->json([
                    'statut' => 400,
                    'message' => 'Toutes les informations sont requises'
                ], 400);
            }

            $commande = Commande::findOrFail($id);
            if ($commande->statut !== 'livré') {
                throw new \Exception("La commande doit être livrée pour être dispatchée");
            }

            // Chercher l'item dans les matériels et consommables
            $demandes = Demande::whereIn('id', $commande->id_demande)
                ->with(['demandeMateriels.stockMateriel', 'demandeConsommables', 'user'])
                ->get();

            $itemFound = false;
            foreach ($demandes as $demande) {
                // Chercher dans les matériels
                foreach ($demande->demandeMateriels as $materiel) {
                    if ($materiel->id == $item_id && $materiel->a_commander) {
                        $itemFound = true;
                        
                        $departement = Departement::where('id_user', $demande->user->id)->first();
                        if (!$departement) {
                            throw new \Exception("Aucun département trouvé pour l'utilisateur");
                        }

                        // Récupérer le type de matériel depuis le stock
                        $typeMateriel = 1; // Type par défaut
                        if ($materiel->stockMateriel) {
                            $typeMateriel = $materiel->stockMateriel->id_type_materiel;
                        }

                        // Créer le nouveau matériel
                        $nouveauMateriel = new Materiel([
                            'libelle' => $materiel->libelle,
                            'marque' => $materiel->marque ?? '',
                            'quantite' => $quantite,
                            'id_departement' => $departement->id,
                            'id_batiment' => $batiment_id,
                            'id_salle' => $salle_id,
                            'date_entree' => now(),
                            'id_etat' => 1,
                            'source' => 'commande',
                            'id_type_materiel' => $typeMateriel
                        ]);
                        $nouveauMateriel->save();

                        // Créer l'entrée de dispatching
                        Dispatching::create([
                            'quantite' => $quantite,
                            'id_departement' => $departement->id,
                            'id_batiment' => $batiment_id,
                            'id_salle' => $salle_id,
                            'id_materiel' => $nouveauMateriel->id,
                            'id_user' => $demande->user->id,
                            'id_demande' => $demande->id
                        ]);

                        // Si toute la quantité a été dispatchée, marquer comme non à commander
                        $dispatchedTotal = Dispatching::where('id_demande', $demande->id)
                            ->where('id_materiel', $materiel->id)
                            ->sum('quantite');
                            
                        if ($dispatchedTotal >= $materiel->quantite) {
                            $materiel->update(['a_commander' => false]);
                        }
                        break;
                    }
                }

                // Chercher dans les consommables
                if (!$itemFound) {
                    foreach ($demande->demandeConsommables as $consommable) {
                        if ($consommable->id == $item_id && $consommable->a_commander) {
                            $itemFound = true;
                            
                            $departement = Departement::where('id_user', $demande->user->id)->first();
                            if (!$departement) {
                                throw new \Exception("Aucun département trouvé pour l'utilisateur");
                            }

                            // Créer le nouveau consommable
                            $nouveauConsommable = new Consommable([
                                'libelle' => $consommable->libelle,
                                'marque' => $consommable->marque ?? '',
                                'quantite' => $quantite,
                                'id_departement' => $departement->id,
                                'id_batiment' => $batiment_id,
                                'id_salle' => $salle_id,
                                'date_entree' => now(),
                                'source' => 'commande'
                            ]);
                            $nouveauConsommable->save();

                            // Créer l'entrée de dispatching
                            Dispatching::create([
                                'quantite' => $quantite,
                                'id_departement' => $departement->id,
                                'id_batiment' => $batiment_id,
                                'id_salle' => $salle_id,
                                'id_consommable' => $nouveauConsommable->id,
                                'id_user' => $demande->user->id,
                                'id_demande' => $demande->id
                            ]);

                            // Si toute la quantité a été dispatchée, marquer comme non à commander
                            $dispatchedTotal = Dispatching::where('id_demande', $demande->id)
                                ->where('id_consommable', $consommable->id)
                                ->sum('quantite');
                                
                            if ($dispatchedTotal >= $consommable->quantite) {
                                $consommable->update(['a_commander' => false]);
                            }
                            break;
                        }
                    }
                }
            }

            if (!$itemFound) {
                throw new \Exception("Item non trouvé ou déjà dispatché");
            }

            DB::commit();
            return response()->json([
                'statut' => 200,
                'message' => 'Dispatching effectué avec succès'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors du dispatching: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors du dispatching: ' . $e->getMessage()
            ], 500);
        }
    }
}
