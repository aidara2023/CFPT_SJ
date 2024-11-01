<?php

namespace App\Http\Controllers\recouvrement;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Location;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class recouvrement_controller extends Controller
{
    /*   public function filtre(Request $request)
    {
        $id_annee_academique = $request->input('id_annee_academique');
        $id_mois = $request->input('id_mois');
        $id_departement = $request->input('id_departement');
        $id_unite_de_formation = $request->input('id_unite_de_formation');
        $id_classe = $request->input('id_classe');

        $eleve_non_payers = [];

        $inscriptions = Eleve::with('inscription.classe.type_formation', 'user', 'inscription.classe')->get();
        $paiements = Paiement::with('eleve.inscription.classe', 'concerner.mois', 'concerner.annee_academique', 'eleve.inscription.classe.unite_de_formation.departement')->get();

        foreach ($inscriptions as $inscription) {
            foreach ($inscription->inscription as $inscriptionItem) {
                $classe = $inscriptionItem->classe;

                if (($classe->type_classe == "FPJ" || $classe->type_classe == "CS")) {
                    $elevePaye = $paiements->contains('id_eleve', $inscriptionItem->eleve->id);

                    if (!$elevePaye) {
                        $hasFilters = $paiements->filter(function ($paiement) use ($id_annee_academique, $id_mois, $id_departement, $id_unite_de_formation, $id_classe, $inscriptionItem) {
                            return $paiement->when($id_annee_academique, function ($query) use ($id_annee_academique) {
                                $query->whereHas('concerner.annee_academique', function ($query) use ($id_annee_academique) {
                                    $query->whereIn('id', (array) $id_annee_academique);
                                });
                            })
                            ->when($id_mois, function ($query) use ($id_mois) {
                                $query->whereHas('concerner.mois', function ($query) use ($id_mois) {
                                    $query->whereIn('id', (array) $id_mois);
                                });
                            })
                            ->when($id_departement, function ($query) use ($id_departement) {
                                $query->whereHas('eleve.inscription.classe.unite_de_formation.departement', function ($query) use ($id_departement) {
                                    $query->whereIn('id', (array) $id_departement);
                                });
                            })
                            ->when($id_unite_de_formation, function ($query) use ($id_unite_de_formation) {
                                $query->whereHas('eleve.inscription.classe.unite_de_formation', function ($query) use ($id_unite_de_formation) {
                                    $query->whereIn('id', (array) $id_unite_de_formation);
                                });
                            })
                            ->when($id_classe, function ($query) use ($id_classe) {
                                $query->whereHas('eleve.inscription.classe', function ($query) use ($id_classe) {
                                    $query->whereIn('id', (array) $id_classe);
                                });
                            })
                            ->exists();
                        });

                        if ($hasFilters) {
                            $eleve_non_payers[] = $inscriptionItem->eleve->id;
                            break; // Sortir de la boucle dès qu'un élève non payeur est trouvé
                        }
                    }
                }
            }
        }
        dd($eleve_non_payers);
        
        if (!empty($eleve_non_payers)) {
            return response()->json([
                'statut' => 200,
                'eleve_non_payer' => $eleve_non_payers,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    } */
    /*    public function filtre(Request $request)
    {
        $id_annee_academique = $request->input('id_annee_academique');
        $id_mois = $request->input('id_mois');
        $id_departement = $request->input('id_departement');
        $id_unite_de_formation = $request->input('id_unite_de_formation');
        $id_classe = $request->input('id_classe');

        $eleve_non_payers = [];
        //dd($request->all());

        $elevess = Eleve::with('inscription.classe.type_formation', 'user', 'inscription.classe.unite_de_formation.departement')->get();
        $paiements = Paiement::with('concerner.mois', 'concerner.annee_academique', 'eleve.inscription.classe.unite_de_formation')->get();

        foreach ($elevess as $eleves) {
            //dd($eleves);
            foreach ($eleves->inscription ?? [] as $eleve) {
                $user = optional($eleve->eleve)->user;
               
        
                $classe = optional($eleve->classe);
                
               
        
                if ($classe && ($classe->type_classe == "FPJ" || $classe->type_classe == "CS")) {
                    $paiementEleve = $paiements->where('id_eleve', $eleve->id)->first();
                    
                    // Vérifier si l'élève a des paiements correspondant aux critères
                    $hasPaiement = $paiementEleve &&
                        $paiementEleve->concerner->where('id_annee_academique', $id_annee_academique)->where('id_mois', $id_mois)->count() > 0;
        
                    $classeUnite = optional($classe->unite_de_formation);
        
                    // Vérifier la présence de 'unite_de_formation' avant d'accéder à 'departement'
                    $hasPaiement = $hasPaiement && $classeUnite && optional($classeUnite->departement)->id == $id_departement;
        
                    if (!$hasPaiement) {
                        //dd(($eleve->eleve)->user->matricule);
                        $eleve_non_payers[] = [
                            'id_eleve' => $eleve->id,
                            'matricule' => optional($eleve->eleve)->user->matricule,
                            'photo' => optional($eleve->eleve)->user->photo,
                            'nom' => optional($eleve->eleve)->user->nom,
                            'prenom' => optional($eleve->eleve)->user->prenom,
                        ];
                    }
                }
            }
        }
        
        
        //dd($eleve_non_payers);

        if (!empty($eleve_non_payers)) {
            return response()->json([
                'statut' => 200,
                'eleve_non_payer' => $eleve_non_payers,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    } */

  /*   public function filtre(Request $request)
    {
        $id_annee_academique = $request->input('id_annee_academique');
        $id_mois = $request->input('id_mois');
        $id_departement = $request->input('id_departement');
        $id_unite_de_formation = $request->input('id_unite_de_formation');
        $id_classe = $request->input('id_classe');

        $eleve_non_payers = [];

        $elevess = Eleve::with('inscription.classe.type_formation', 'user', 'inscription.classe.unite_de_formation.departement', 'inscription.classe')
            ->whereHas('inscription.classe', function ($query) use ($id_classe, $id_unite_de_formation, $id_departement) {
                $query->when($id_classe, function ($q) use ($id_classe) {
                    $q->whereIn('id', (array) $id_classe);
                })
                    ->when($id_unite_de_formation, function ($q) use ($id_unite_de_formation) {
                        $q->whereHas('unite_de_formation', function ($q) use ($id_unite_de_formation) {
                            $q->whereIn('id', (array) $id_unite_de_formation);
                        });
                    })
                    ->when($id_departement, function ($q) use ($id_departement) {
                        $q->whereHas('unite_de_formation.departement', function ($q) use ($id_departement) {
                            $q->whereIn('id', (array) $id_departement);
                        });
                    });
            })
            ->get();

        // Charger les paiements en fonction des critères
        $paiements = Paiement::with('concerner.mois', 'concerner.annee_academique', 'eleve.inscription.classe.unite_de_formation')
            ->whereHas('concerner', function ($query) use ($id_annee_academique, $id_mois) {
                $query->when($id_annee_academique, function ($q) use ($id_annee_academique) {
                    $q->whereHas('annee_academique', function ($q) use ($id_annee_academique) {
                        $q->whereIn('id', (array) $id_annee_academique);
                    });
                })
                    ->when($id_mois, function ($q) use ($id_mois) {
                        $q->whereHas('mois', function ($q) use ($id_mois) {
                            $q->whereIn('id', (array) $id_mois);
                        });
                    });
            })
            ->get();

        foreach ($elevess as $eleves) {
            foreach ($eleves->inscription ?? [] as $eleve) {
                $classe = optional($eleve->classe);
                if ($classe && ($classe->type_classe == "FPJ" || $classe->type_classe == "CS" || $classe->type_classe == "CPS")) {
                    $montantTotalPaiements = 0;

                     if (!$paiements->isEmpty()) {
                        foreach($paiements as $paiement){
                            if($paiement->id_eleve!== $eleves->id && $classe->type_formation->intitule == 'BTS '){
                                $eleve_non_payers[] = [
                                    'id_eleve' => $eleves->id,
                                    'matricule' => optional($eleve->eleve)->user->matricule,
                                    'photo' => optional($eleve->eleve)->user->photo,
                                    'nom' => optional($eleve->eleve)->user->nom,
                                    'prenom' => optional($eleve->eleve)->user->prenom,
                                    'paiement' =>70000
                                ];
                            }
                            elseif($paiement->id_eleve!== $eleves->id && $classe->type_formation->intitule == 'BTI'){
                                $eleve_non_payers[] = [
                                    'id_eleve' => $eleves->id,
                                    'matricule' => optional($eleve->eleve)->user->matricule,
                                    'photo' => optional($eleve->eleve)->user->photo,
                                    'nom' => optional($eleve->eleve)->user->nom,
                                    'prenom' => optional($eleve->eleve)->user->prenom,
                                    'paiement' =>50000
                                ];
                            }
                        }
                    }
                    
                        foreach($paiements as $paiement){
                            if ($paiement && $paiement->id_eleve == $eleves->id) {
                            $montantTotalPaiements += $paiement->montant;
                        }
                        }
                        $montantRestant = 70000 - $montantTotalPaiements;

                        $eleve_non_payers[] = [
                            'id_eleve' => $eleves->id,
                            'matricule' => optional($eleve->eleve)->user->matricule,
                            'photo' => optional($eleve->eleve)->user->photo,
                            'nom' => optional($eleve->eleve)->user->nom,
                            'prenom' => optional($eleve->eleve)->user->prenom,
                            'paiement' =>$montantRestant
                        ];
                    
                }
            }
        }

        if (!empty($eleve_non_payers)) {

            return response()->json([
                'statut' => 200,
                'eleve_non_payer' => $eleve_non_payers,
            ], 200);
        } else {

            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    } */
    public function filtre(Request $request)
    {
        $id_annee_academique = $request->input('id_annee_academique');
        $id_mois = $request->input('id_mois');
        $id_departement = $request->input('id_departement');
        $id_unite_de_formation = $request->input('id_unite_de_formation');
        $id_classe = $request->input('id_classe');
    
        $eleve_non_payers = [];
    
        $elevess = Eleve::with('inscription.classe.type_formation', 'user', 'inscription.classe.unite_de_formation.departement', 'inscription.classe')
            ->whereHas('inscription.classe', function ($query) use ($id_classe, $id_unite_de_formation, $id_departement) {
                $query->when($id_classe, function ($q) use ($id_classe) {
                    $q->whereIn('id', (array) $id_classe);
                })
                    ->when($id_unite_de_formation, function ($q) use ($id_unite_de_formation) {
                        $q->whereHas('unite_de_formation', function ($q) use ($id_unite_de_formation) {
                            $q->whereIn('id', (array) $id_unite_de_formation);
                        });
                    })
                    ->when($id_departement, function ($q) use ($id_departement) {
                        $q->whereHas('unite_de_formation.departement', function ($q) use ($id_departement) {
                            $q->whereIn('id', (array) $id_departement);
                        });
                    });
            })
            ->get();
    
        // Charger les paiements en fonction des critères
        $paiements = Paiement::with('concerner.mois', 'concerner.annee_academique', 'eleve.inscription.classe.unite_de_formation')
            ->whereHas('concerner', function ($query) use ($id_annee_academique, $id_mois) {
                $query->when($id_annee_academique, function ($q) use ($id_annee_academique) {
                    $q->whereHas('annee_academique', function ($q) use ($id_annee_academique) {
                        $q->whereIn('id', (array) $id_annee_academique);
                    });
                })
                    ->when($id_mois, function ($q) use ($id_mois) {
                        $q->whereHas('mois', function ($q) use ($id_mois) {
                            $q->whereIn('id', (array) $id_mois);
                        });
                    });
            })
            ->get();
    
        foreach ($elevess as $eleves) {
            foreach ($eleves->inscription ?? [] as $eleve) {
                $classe = optional($eleve->classe);
                if ($classe && in_array($classe->type_classe, ["FPJ", "CS", "CPS"])) {
                    $montantTotalPaiements = 0;
    
                    foreach ($paiements as $paiement) {
                        if ($paiement->id_eleve == $eleves->id) {
                            $montantTotalPaiements += $paiement->montant;
                        }
                    }
    
                    $montantRestant = ($classe->type_formation->intitule == 'BTS ') ? 70000 - $montantTotalPaiements : 50000 - $montantTotalPaiements;
    
                    if ($montantRestant > 0) {
                        $eleve_non_payers[] = [
                            'id_eleve' => $eleves->id,
                            'matricule' => optional($eleve->eleve)->user->matricule,
                            'photo' => optional($eleve->eleve)->user->photo,
                            'nom' => optional($eleve->eleve)->user->nom,
                            'prenom' => optional($eleve->eleve)->user->prenom,
                            'paiement' => $montantRestant
                        ];
                    }
                }
            }
        }
    
        if (!empty($eleve_non_payers)) {
    
            return response()->json([
                'statut' => 200,
                'eleve_non_payer' => $eleve_non_payers,
            ], 200);
        } else {
    
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }
    



    public function filtre_saf(Request $request)
    {
    
       // Récupérer les paramètres de la requête
    $annee = $request->input('annee');
    $id_partenaire = $request->input('id_partenaire');
    $date = $request->input('date');

    // Récupérer les locations pour l'année académique, le partenaire et avant la date spécifiée
    $query = Location::query();

    if ($annee) {
        $query->where(DB::raw('YEAR(date_location)'), $annee);
    }

    if ($id_partenaire) {
        $query->where('id_partenaire', $id_partenaire);
    }

    if ($date) {
        $query->where('date_location', '<=', $date);
    }

    $locations = $query->with('factures.location.partenaire', 'factures.location.salle')->get();

    // Initialiser le cumul des montants payés
    $cumulMontantPayer = 0;

    // Initialiser la liste des factures non soldées
    $facturesNonSoldees = [];

    // Parcourir les locations
    foreach ($locations as $location) {
        // Calculer le montant total de la location
        $montant_total = $location->nombre_jour * $location->montant_jour;

        // Récupérer les factures pour cette location
        $factures = $location->factures;

        // Calculer le montant total payé pour cette location
        $montant_payer = $factures->sum('montant_payer');

        // Vérifier si le montant payé est inférieur au montant total de la location
        if ($montant_payer < $montant_total) {
            // Ajouter les factures non soldées à la liste
            $facturesNonSoldees = array_merge($facturesNonSoldees, $factures->toArray());
        }

        // Ajouter le montant payé au cumul des montants payés
        $cumulMontantPayer += $montant_payer;
    }

    // Retourner les factures non soldées et le cumul des montants payés
    if (!empty($facturesNonSoldees)) {

        return response()->json([
            'statut' => 200,
            'factures_non_soldees' => $facturesNonSoldees,
            'cumul_montant_payer' => $cumulMontantPayer
        ], 200);
    } else {

        return response()->json([
            'statut' => 500,
            'message' => 'Aucune donnée trouvée',
        ], 500);
    }
    
    
    }
}