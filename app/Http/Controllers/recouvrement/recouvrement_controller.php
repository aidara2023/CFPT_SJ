<?php

namespace App\Http\Controllers\recouvrement;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Paiement;
use Illuminate\Http\Request;

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
    public function filtre(Request $request)
    {
        $id_annee_academique = $request->input('id_annee_academique');
        $id_mois = $request->input('id_mois');
        $id_departement = $request->input('id_departement');
        $id_unite_de_formation = $request->input('id_unite_de_formation');
        $id_classe = $request->input('id_classe');

        $eleve_non_payers = [];

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
    }
}
