<?php

namespace App\Http\Controllers\participer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participer;

class participer_controller extends Controller
{
    public function index(){
        $participer = Participer::all();
        if($participer != null){
            return response()->json([
                'statut' => 200,
                'participer' => $participer
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
            'date_participation' => 'required',
            'id_seminaire' => 'required',
            'id_formateur' => 'required'
        ]);

        $participer = Participer::create($data);
        if($participer != null){
            return response()->json([
                'statut' => 200,
                'participer' => $participer
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function mise_a_jour(Request $request, $id) {
        $participer = Participer::find($id);
        if($participer != null){
            $participer -> date_participation = $request['date_participation'];
            $participer -> id_participation = $request['id_participation'];
            $participer -> id_formateur = $request['id_formateur'];
            $participer -> save();

            return response()->json([
                'statut' => 200,
                'participer' => $participer
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function supprimer($id) {
        $participer = Participer::find($id);
        if($participer != null){
            $participer -> delete();
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
        $participer = Participer::find($id);
        if($participer != null){
            return response()->json([
                'statut' => 200,
                'participer' => $participer
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'participer' => 'Cette participation n\'a pas été effectué'
            ],500);
        }
    }
}
