<?php

namespace App\Http\Controllers\annee_academique;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annee_academique;

class annee_academique_controller extends Controller
{
    public function index(){
        $annee_academique = Annee_academique::all();
        if($annee_academique != null){
            return response()->json([
                'statut' => 200,
                'annee_academique' => $annee_academique
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
            'intitule' => 'required'
        ]);

        $annee_academique = Annee_academique::create($data);
        if($annee_academique != null){
            return response()->json([
                'statut' => 200,
                'annee_academique' => $annee_academique
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function mise_a_jour(Request $request, $id) {
        $annee_academique = Annee_academique::find($id);
        if($annee_academique != null){
            $annee_academique -> id = $request['id'];
            $annee_academique -> intitule = $request['intitule'];
            $annee_academique -> save();

            return response()->json([
                'statut' => 200,
                'annee_academique' => $annee_academique
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function supprimer($id) {
        $annee_academique = Annee_academique::find($id);
        if($annee_academique != null){
            $annee_academique -> delete();
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
        $annee_academique = Annee_academique::find($id);
        if($annee_academique != null){
            return response()->json([
                'statut' => 200,
                'annee_academique' => $annee_academique
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'annee_academique' => 'Cette année académique n\'existe pas'
            ],500);
        }
    }
}
