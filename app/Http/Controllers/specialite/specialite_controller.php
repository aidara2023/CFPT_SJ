<?php

namespace App\Http\Controllers\specialite;

use App\Http\Controllers\Controller;
use App\Http\Requests\specialite\specialite_request;
use Illuminate\Http\Request;
use App\Models\Specialite;

class specialite_controller extends Controller
{

    public function index(){
        $specialite = Specialite::all();
        if($specialite != null){
            return response()->json([
                'statut' => 200,
                'specialite' => $specialite
            ] ,200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été éffectué'
            ] ,500);
        }
    }

    public function store(specialite_request $request){
        $data = $request -> validated();

        $specialite = Specialite::create($data);
        if($specialite != null){
            return response() -> json([
                'statut' => 200,
                'specialite' => $specialite
            ] ,200);
        } else {
            return response() -> json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a été éffectué'
            ]);
        }
    }

    public function update(specialite_request $request, $id) {
        $specialite = Specialite::find($id);
        if($specialite != null){
            $specialite -> intitule = $request['intitule'];
            $specialite -> save();

            return response()->json([
                'statut' => 200,
                '$specialite' => $specialite
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function delete($id) {
        $specialite = Specialite::find($id);
        if($specialite != null){
            $specialite -> delete();
            return response()->json([
                'statut' => 200,
                'message' => 'L\'enregistrement a pas été supprimé avec succés'
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été supprimé'
            ],500);
        }
    }

    public function show($id) {
        $specialite = Specialite::find($id);
        if($specialite != null){
            return response()->json([
                'statut' => 200,
                '$specialite' => $specialite
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                '$specialite' => 'Cette spécialité n\'a pas été enregistré'
            ],500);
        }
    }
}
