<?php

namespace App\Http\Controllers\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\Dispatching;
use App\Models\Materiel;
use App\Models\Consommable;
use App\Models\Demande;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DispatchingController extends Controller
{
    public function dispatcherVersSalle(Request $request)
    {
        try {
            // Validation des données
            $request->validate([
                'id_salle' => 'required|exists:salles,id',
                'id_demande' => 'required|exists:demandes,id', // Ajout de la demande d'origine
                'items' => 'required|array',
                'items.*.type' => 'required|in:materiel,consommable',
                'items.*.id' => 'required|integer',
                'items.*.quantite' => 'required|integer|min:1'
            ]);

            // Récupérer la demande d'origine
            $demande = Demande::findOrFail($request->id_demande);

            foreach ($request->items as $item) {
                if ($item['type'] === 'materiel') {
                    $materiel = Materiel::findOrFail($item['id']);
                    
                    // Vérifier que le matériel appartient bien au département de l'utilisateur
                    if ($materiel->id_departement !== auth()->user()->id_departement) {
                        throw new \Exception('Ce matériel n\'appartient pas à votre département');
                    }

                    // Vérifier la quantité disponible
                    if ($materiel->quantite < $item['quantite']) {
                        throw new \Exception('Quantité insuffisante pour ' . $materiel->libelle);
                    }

                    // Créer le dispatching avec référence à la demande d'origine
                    Dispatching::create([
                        'quantite' => $item['quantite'],
                        'id_departement' => auth()->user()->id_departement,
                        'id_salle' => $request->id_salle,
                        'id_user' => auth()->id(),
                        'id_materiel' => $materiel->id,
                        'id_demande' => $request->id_demande // Garder la référence à la demande
                    ]);

                    // Mettre à jour la quantité du matériel
                    $materiel->decrement('quantite', $item['quantite']);
                }
                else { // consommable
                    $consommable = Consommable::findOrFail($item['id']);
                    
                    // Vérifier que le consommable appartient bien au département
                    if ($consommable->id_departement !== auth()->user()->id_departement) {
                        throw new \Exception('Ce consommable n\'appartient pas à votre département');
                    }

                    // Vérifier la quantité disponible
                    if ($consommable->quantite < $item['quantite']) {
                        throw new \Exception('Quantité insuffisante pour ' . $consommable->libelle);
                    }

                    // Créer le dispatching avec référence à la demande d'origine
                    Dispatching::create([
                        'quantite' => $item['quantite'],
                        'id_departement' => auth()->user()->id_departement,
                        'id_salle' => $request->id_salle,
                        'id_user' => auth()->id(),
                        'id_consommable' => $consommable->id,
                        'id_demande' => $request->id_demande // Garder la référence à la demande
                    ]);

                    // Mettre à jour la quantité du consommable
                    $consommable->decrement('quantite', $item['quantite']);
                }
            }

            return response()->json([
                'statut' => 200,
                'message' => 'Dispatching effectué avec succès'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors du dispatching: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors du dispatching: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getDispatchingsParDemandeEtSalle($id_demande, $id_salle)
    {
        try {
            $dispatchings = Dispatching::with(['materiel', 'consommable'])
                ->where('id_demande', $id_demande)
                ->where('id_salle', $id_salle)
                ->where('id_departement', auth()->user()->id_departement)
                ->get();

            return response()->json([
                'statut' => 200,
                'dispatchings' => $dispatchings
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des dispatchings: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des dispatchings'
            ], 500);
        }
    }

    public function index()
    {
        try {
            $dispatchings = Dispatching::with(['materiel', 'consommable', 'salle', 'user', 'demande'])
                ->where('id_departement', auth()->user()->id_departement)
                ->get();

            return response()->json([
                'statut' => 200,
                'dispatchings' => $dispatchings
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des dispatchings: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des dispatchings'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Récupérer la commande avec ses relations
            $commande = \App\Models\Commande::with([
                'demandes.user.departement',
                'demandes.demandeMateriels.materiel',
                'demandes.demandeConsommables.consommable'
            ])->findOrFail($id);

            return response()->json([
                'statut' => 200,
                'commande' => [
                    'id' => $commande->id,
                    'reference_commande' => $commande->reference,
                    'date_commande' => $commande->created_at,
                    'statut' => $commande->statut
                ],
                'demandes' => $commande->demandes->map(function ($demande) {
                    return [
                        'id' => $demande->id,
                        'user' => [
                            'name' => $demande->user->name,
                            'departement' => [
                                'nom' => $demande->user->departement->nom
                            ]
                        ],
                        'demandeMateriels' => $demande->demandeMateriels->map(function ($dm) {
                            return [
                                'id' => $dm->id,
                                'libelle' => $dm->materiel->libelle,
                                'marque' => $dm->materiel->marque,
                                'quantite' => $dm->quantite,
                                'a_commander' => true
                            ];
                        }),
                        'demandeConsommables' => $demande->demandeConsommables->map(function ($dc) {
                            return [
                                'id' => $dc->id,
                                'libelle' => $dc->consommable->libelle,
                                'marque' => $dc->consommable->marque,
                                'quantite' => $dc->quantite,
                                'a_commander' => true
                            ];
                        })
                    ];
                })
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération de la commande: ' . $e->getMessage());
            return response()->json([
                'statut' => 404,
                'message' => 'Commande non trouvée'
            ], 404);
        }
    }
}
