<?php

namespace App\Http\Controllers\departement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departement;

class departement_controller extends Controller
{
    public function index(){
        $departement = Departement::all();
        if($departement != null){
            return response()->json([
                'statut' => 200,
                'departement' => $departement
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
            'intitule' => 'required',
            'nom_direction' => 'required',
            'id_direction' => 'required'
        ]);

        $departement = Departement::create($data);
        if($departement != null){
            return response()->json([
                'statut' => 200,
                'departement' => $departement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function mise_a_jour(Request $departement, $id) {
        $departement = Departement::find($id);
        if($departement != null){
            $departement -> intitule = $request['intitule'];
            $departement -> nom_direction = $request['nom_direction'];
            $departement -> id_direction = $request['id_direction'];
            $departement -> save();

            return response()->json([
                'statut' => 200,
                'departement' => $departement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function supprimer($id) {
        $departement = Departement::find($id);
        if($departement != null){
            $departement -> delete();
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
        $departement = Departement::find($id);
        if($departement != null){
            return response()->json([
                'statut' => 200,
                'departement' => $departement
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'departement' => 'Ce département n\'existe pas'
            ],500);
        }
    }
}
