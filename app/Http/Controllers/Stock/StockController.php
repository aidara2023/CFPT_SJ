<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\StockMateriel;
use App\Models\StockConsommable;
use App\Models\Dispatching;
use App\Models\Materiel;
use App\Models\Consommable;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function verifierDisponibilite($id)
    {
        try {
            $demande = Demande::with(['demandeMateriels', 'demandeConsommables'])->findOrFail($id);
            
            // Ne vérifier que si la demande est validée
            if ($demande->statut !== Demande::STATUT_VALIDE) {
                return response()->json([
                    'statut' => 400,
                    'message' => 'La demande doit être validée avant de vérifier la disponibilité'
                ]);
            }

            $hasFullyAvailable = false; // Au moins un article totalement disponible
            $hasPartiallyAvailable = false; // Au moins un article partiellement disponible
            $hasUnavailable = false; // Au moins un article non disponible

            // Vérifier les matériels
            foreach ($demande->demandeMateriels as $materiel) {
                $stockMateriel = StockMateriel::where('libelle', $materiel->libelle)->first();
                $quantiteDisponible = $stockMateriel ? $stockMateriel->quantite_disponible : 0;
                
                if (!$stockMateriel || $quantiteDisponible === 0) {
                    // Aucun stock disponible
                    $hasUnavailable = true;
                    $materiel->a_commander = true;
                } elseif ($quantiteDisponible < $materiel->quantite) {
                    // Stock partiellement disponible
                    $hasPartiallyAvailable = true;
                    $materiel->a_commander = true;
                } else {
                    // Stock totalement disponible
                    $hasFullyAvailable = true;
                    $materiel->a_commander = false;
                }
                $materiel->save();
            }

            // Vérifier les consommables
            foreach ($demande->demandeConsommables as $consommable) {
                $stockConsommable = StockConsommable::where('libelle', $consommable->libelle)->first();
                $quantiteDisponible = $stockConsommable ? $stockConsommable->quantite_disponible : 0;
                
                if (!$stockConsommable || $quantiteDisponible === 0) {
                    // Aucun stock disponible
                    $hasUnavailable = true;
                    $consommable->a_commander = true;
                } elseif ($quantiteDisponible < $consommable->quantite) {
                    // Stock partiellement disponible
                    $hasPartiallyAvailable = true;
                    $consommable->a_commander = true;
                } else {
                    // Stock totalement disponible
                    $hasFullyAvailable = true;
                    $consommable->a_commander = false;
                }
                $consommable->save();
            }

            // Déterminer le statut global de la demande
            if ($hasFullyAvailable && !$hasPartiallyAvailable && !$hasUnavailable) {
                // Tout est disponible
                $demande->checking_status = Demande::CHECKING_DISPONIBLE;
            } elseif (!$hasFullyAvailable && !$hasPartiallyAvailable && $hasUnavailable) {
                // Rien n'est disponible
                $demande->checking_status = Demande::CHECKING_NON_DISPONIBLE;
            } else {
                // Mélange de disponibilités
                $demande->checking_status = Demande::CHECKING_PARTIELLEMENT_DISPONIBLE;
            }
            
            $demande->save();

            return response()->json([
                'statut' => 200,
                'message' => 'Vérification effectuée avec succès',
                'checking_status' => $demande->checking_status
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la vérification du stock: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la vérification du stock'
            ], 500);
        }
    }

    public function dispatcherStock($id)
    {
        try {
            Log::info("Début du dispatch du stock pour la demande ID: " . $id);
            
            $demande = Demande::with(['demandeMateriels', 'demandeConsommables', 'user'])->findOrFail($id);
            Log::info("Demande chargée:", ['demande' => $demande->toArray()]);
            
            $tousDisponibles = true;
            $auMoinsUnDisponible = false;
            
            // Dispatcher les matériels disponibles
            foreach ($demande->demandeMateriels as $materiel) {
                Log::info("Traitement du matériel:", ['materiel' => $materiel->toArray()]);
                
                $stockMateriel = StockMateriel::where('libelle', $materiel->libelle)
                    ->where('quantite_disponible', '>=', $materiel->quantite)
                    ->first();
                
                Log::info("Stock matériel trouvé:", ['stock' => $stockMateriel ? $stockMateriel->toArray() : 'Aucun']);

                if ($stockMateriel) {
                    $auMoinsUnDisponible = true;
                    try {
                        // Récupérer le département où l'utilisateur est chef
                        $departement = Departement::where('id_user', $demande->user->id)->first();
                        if (!$departement) {
                            throw new \Exception("Aucun département trouvé pour cet utilisateur");
                        }

                        // Créer un nouveau matériel pour le département (source = stock)
                        $nouveauMateriel = new Materiel([
                            'libelle' => $materiel->libelle,
                            'marque' => $stockMateriel->marque,
                            'quantite' => $materiel->quantite,
                            'id_departement' => $departement->id,
                            'date_entree' => now(),
                            'id_etat' => 1,
                            'id_type_materiel' => $stockMateriel->id_type_materiel,
                            'source' => 'stock'
                        ]);
                        $nouveauMateriel->save();
                        Log::info("Nouveau matériel créé:", ['nouveau_materiel' => $nouveauMateriel->toArray()]);

                        // Créer le dispatching avec référence à la demande
                        $dispatching = Dispatching::create([
                            'quantite' => $materiel->quantite,
                            'id_departement' => $departement->id,
                            'id_materiel' => $nouveauMateriel->id,
                            'id_user' => $demande->user->id,
                            'id_demande' => $demande->id
                        ]);
                        Log::info("Dispatching créé:", ['dispatching' => $dispatching->toArray()]);

                        // Décrémentation du stock
                        $stockMateriel->decrement('quantite_disponible', $materiel->quantite);
                        Log::info("Stock décrémenté", [
                            'stock_id' => $stockMateriel->id,
                            'nouvelle_quantite' => $stockMateriel->quantite_disponible
                        ]);
                    } catch (\Exception $e) {
                        Log::error("Erreur lors de la création du matériel:", [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        throw $e;
                    }
                } else {
                    $tousDisponibles = false;
                    Log::warning("Matériel non disponible en stock:", ['materiel' => $materiel->libelle]);
                }
            }

            // Dispatcher les consommables disponibles
            foreach ($demande->demandeConsommables as $consommable) {
                Log::info("Traitement du consommable:", ['consommable' => $consommable->toArray()]);
                
                $stockConsommable = StockConsommable::where('libelle', $consommable->libelle)
                    ->where('quantite_disponible', '>=', $consommable->quantite)
                    ->first();
                
                Log::info("Stock consommable trouvé:", ['stock' => $stockConsommable ? $stockConsommable->toArray() : 'Aucun']);

                if ($stockConsommable) {
                    $auMoinsUnDisponible = true;
                    try {
                        // Récupérer le département où l'utilisateur est chef
                        $departement = Departement::where('id_user', $demande->user->id)->first();
                        if (!$departement) {
                            throw new \Exception("Aucun département trouvé pour cet utilisateur");
                        }

                        // Créer un nouveau consommable pour le département (source = stock)
                        $nouveauConsommable = new Consommable([
                            'libelle' => $consommable->libelle,
                            'marque' => $stockConsommable->marque,
                            'quantite' => $consommable->quantite,
                            'id_departement' => $departement->id,
                            'date_entree' => now(),
                            'id_etat' => 1,
                            'source' => 'stock'
                        ]);
                        $nouveauConsommable->save();
                        Log::info("Nouveau consommable créé:", ['nouveau_consommable' => $nouveauConsommable->toArray()]);

                        // Créer le dispatching avec référence à la demande
                        $dispatching = Dispatching::create([
                            'quantite' => $consommable->quantite,
                            'id_departement' => $departement->id,
                            'id_consommable' => $nouveauConsommable->id,
                            'id_user' => $demande->user->id,
                            'id_demande' => $demande->id
                        ]);
                        Log::info("Dispatching créé:", ['dispatching' => $dispatching->toArray()]);

                        // Décrémentation du stock
                        $stockConsommable->decrement('quantite_disponible', $consommable->quantite);
                        Log::info("Stock décrémenté", [
                            'stock_id' => $stockConsommable->id,
                            'nouvelle_quantite' => $stockConsommable->quantite_disponible
                        ]);
                    } catch (\Exception $e) {
                        Log::error("Erreur lors de la création du consommable:", [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        throw $e;
                    }
                } else {
                    $tousDisponibles = false;
                    Log::warning("Consommable non disponible en stock:", ['consommable' => $consommable->libelle]);
                }
            }

            // Mettre à jour le statut de la demande
            if ($tousDisponibles) {
                $demande->update(['statut' => 'traitée']);
                Log::info("Demande marquée comme traitée");
            } else if ($auMoinsUnDisponible) {
                $demande->update(['statut' => 'validé']);
                Log::info("Demande marquée comme validée");
            }

            Log::info("Fin du dispatch du stock pour la demande ID: " . $id);
            return response()->json([
                'statut' => 200,
                'message' => 'Stock dispatché avec succès'
            ]);

        } catch (\Exception $e) {
            Log::error("Erreur fatale lors du dispatch du stock:", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors du dispatch du stock: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getItemsNonDisponibles($id)
    {
        try {
            $demande = Demande::with(['demandeMateriels', 'demandeConsommables', 'stockMateriels', 'stockConsommables'])->findOrFail($id);
            
            $itemsACommander = [
                'materiels' => [],
                'consommables' => []
            ];

            // Vérifier les matériels
            foreach ($demande->demandeMateriels as $materiel) {
                $stockMateriel = $demande->stockMateriels()
                    ->where('libelle', $materiel->libelle)
                    ->where('marque', $materiel->marque)
                    ->first();

                if (!$stockMateriel || $stockMateriel->pivot->quantite_disponible < $materiel->quantite) {
                    $itemsACommander['materiels'][] = $materiel;
                }
            }

            // Vérifier les consommables
            foreach ($demande->demandeConsommables as $consommable) {
                $stockConsommable = $demande->stockConsommables()
                    ->where('libelle', $consommable->libelle)
                    ->where('marque', $consommable->marque)
                    ->first();

                if (!$stockConsommable || $stockConsommable->pivot->quantite_disponible < $consommable->quantite) {
                    $itemsACommander['consommables'][] = $consommable;
                }
            }

            return response()->json([
                'statut' => 200,
                'items' => $itemsACommander
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des items non disponibles: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des items'
            ], 500);
        }
    }
}