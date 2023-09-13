<?php

namespace App\Http\Controllers\paiement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;

class paiement_controller extends Controller
{
    public function index(){
        $paiement = Paiement::all();
        if($paiement != null){
            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été éffectué'
            ],500);
        }
    }

    public function ajouter(Request $request) {
        $data = $request -> validate([
            'id_paiement' => 'required',
            'id_eleve' => 'required',
            'id_caissier' => 'required',
            'id_annee_academique' => 'required',
            'mois' => 'required'
        ]);

        $paiement = Paiement::create($data);
        if($paiement != null){
            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function mise_a_jour(Request $paiement, $id) {
        $paiement = Paiement::find($id);
        if($paiement != null){
            $paiement -> id_paiement = $request['id_paiement'];
            $paiement -> id_eleve = $request['id_eleve'];
            $paiement -> id_caissier = $request['id_caissier'];
            $paiement -> id_annee_academique = $request['id_annee_academique'];
            $paiement -> mois = $request['mois'];
            $paiement -> save();

            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function supprimer($id) {
        $paiement = Paiement::find($id);
        if($paiement != null){
            $paiement -> delete();
            return response()->json([
                'statut' => 200,
                'message' => 'L\'enregistrement a été supprimé avec succés'
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été supprimé'
            ],500);
        }
    }

    public function show($id) {
        $paiement = Paiement::find($id);
        if($paiement != null){
            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'paiement' => 'Cet enregistrement n\'existe pas'
            ],500);
        }
    }
}
