<?php

namespace App\Http\Controllers\paiement_partenaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\paiement_partenaire\paiement_partenaire_request;
use App\Models\Facture;
use App\Models\Location;
use App\Models\Paiement_partenaire;
use Illuminate\Http\Request;

class paiement_partenaire_controller extends Controller
{
    public function index()
{
    $paiements = Paiement_partenaire::with(['facture.location.partenaire'])->orderBy('created_at', 'desc')->get();
    if ($paiements->isNotEmpty()) {
        return response()->json([
            'status' => 200,
            'paiement_partenaire' => $paiements
        ], 200);
    } else {
        return response()->json([
            'status' => 500,
            'message' => 'Aucune donnée trouvée',
        ], 500);
    }
}

    

    public function store(paiement_partenaire_request $request)
    {
        $data = $request->validated();

        $paiement_partenaire = paiement_partenaire::create($data);
        if ($paiement_partenaire) {
            return response()->json([
                'status' => 200,
                'paiement_partenaire' => $paiement_partenaire
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'enregistrement n\'a pas été effectué',
            ], 500);
        }
    }

    public function update(paiement_partenaire_request $request, $id)
    {
        $paiement_partenaire = Paiement_partenaire::find($id);
        if ($paiement_partenaire) {
            $data = $request->validate([
                'id_facture' => 'required',
                'date_paiement' => 'required',
                'mode_paiement' => 'required',
                'montant_payer' => 'required'

            ]);

            $paiement_partenaire->update($data);

            return response()->json([
                'status' => 200,
                'paiement_partenaire' => $paiement_partenaire
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'La mise à jour n\'a pas été effectuée',
            ], 500);
        }
    }

    public function delete($id)
    {
        $paiement_partenaire = Paiement_partenaire::find($id);
        if ($paiement_partenaire) {
            $paiement_partenaire->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Paiement supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le paiement n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $paiement_partenaire = Paiement_partenaire::find($id);
        if ($paiement_partenaire) {
            return response()->json([
                'status' => 200,
                'paiement_partenaire' => $paiement_partenaire
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le paiement n\'existe pas',
            ], 500);
        }
    }
    public function recherche_id_facture(Request $request)
    {
        $valeur = $request->input('query');

        $facture = Facture::with('location', 'location.partenaire')
            ->where('id', 'LIKE', "%$valeur%")
            ->get();

        if ($facture->isNotEmpty()) {
            return response()->json($facture);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune facture ne correspond à la recherche.',
            ], 500);
        }
    }
    public function validerFacture(Request $request, $id)
    {
        // Trouver la facture par ID
        $facture = Facture::find($id);

        // Vérifier si la facture existe
        if ($facture) {
           
            // Mettre à jour les champs avec les données de la requête
            $facture->fill($request->only('id_facture', 'montant_payer', 'mode_paiement', 'date_paiement'));

            // Trouver la location associée à cette facture pour obtenir le montant total
            // $location = Location::where('id_facture', $facture->id_facture)->first();
            $location = $facture->id_location;
             
            // Vérifier si la location existe
            if ($location) {
                
                // Calculer le montant total payé jusqu'à présent pour cette facture
                if (Paiement_partenaire::where('id_facture', $facture->id)) {

                    $montantTotalPayeJusquaMaintenant = Paiement_partenaire::where('id_facture', $facture->id)->sum('montant_payer');
                           
                    // Calculer le montant total de la location
                    $montantTotalLocation = $facture->location->montant_jour * $facture->location->nombre_jour;

                    // Calculer le reliquat
                    $reliquat = $montantTotalLocation - $montantTotalPayeJusquaMaintenant;

                    // Mettre à jour le reliquat
                    // $facture->reliquat = $reliquat;

                    // Vérifier si la facture est entièrement payée
                    /* if ($reliquat <= 0) {
                        $facture->statut = 1; // Marquer la facture comme payée
                    } */

                    // Sauvegarder les modifications
                    $facture->save();
                } else {
                    $montantTotalPayeJusquaMaintenant = 0;

                    // Calculer le montant total de la location
                    $montantTotalLocation = $facture->location->montant_jour * $facture->location->nombre_jour;

                    // Calculer le reliquat
                    $reliquat = $montantTotalLocation - $montantTotalPayeJusquaMaintenant;

                    // Mettre à jour le reliquat
                    //$facture->reliquat = $reliquat;

                    // Vérifier si la facture est entièrement payée
                    /* if ($reliquat <= 0) {
                        $facture->statut = 1; // Marquer la facture comme payée
                    } */

                    // Sauvegarder les modifications
                    $facture->save();
                }


                // Retourner une réponse JSON avec un message de succès
                return response()->json([
                    'statut' => 200,
                    'message' => 'La validation de la facture a été effectuée avec succès.',
                    'facture' => $facture,
                    'reliquat' => $reliquat
                    ,
                ], 200);
            } else {
                // Retourner une réponse JSON avec un message d'erreur si la location n'est pas trouvée
                return response()->json([
                    'statut' => 500,
                    'message' => 'La location associée à la facture n\'a pas été trouvée.',
                ], 500);
            }
        } else {
          
            // Retourner une réponse JSON avec un message d'erreur si la facture n'est pas trouvée
            return response()->json([
                'statut' => 404,
                'message' => 'La facture spécifiée n\'a pas été trouvée.',
            ], 404);
        }
    }
}
