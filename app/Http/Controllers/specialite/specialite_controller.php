<?php

namespace App\Http\Controllers\specialite;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\specialite\specialite_request;
use Illuminate\Http\Request;
use App\Models\Specialite;

class specialite_controller extends Controller
{

    public function index(){
        $specialite = Specialite::orderBy('created_at', 'desc')->get();
        if($specialite != null){
            return response()->json([
                'statut' => 200,
                'specialite' => $specialite
            ] ,200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée'
            ] ,500);
        }
    }
    public function all_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $specialite=Specialite::orderBy('created_at', 'desc')->paginate($perPage);
        if($specialite!=null){
            return response()->json([
                'statut'=>200,
                'specialite'=>$specialite
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
     public function get_five_laste() {
        $specialite = Specialite::orderBy('created_at', 'desc')
            ->take(5) // Ajout de cette ligne pour récupérer les 5 derniers enregistrements
            ->get();
    
        if ($specialite->count() > 0) {
            return response()->json([
                'statut' => 200,
                'specialite' => $specialite
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(specialite_request $request){
        $data = $request -> validated();

        $specialite = Specialite::create($data);
        if($specialite != null){
            event(new ModelCreated($specialite));
            return response() -> json([
                'statut' => 200,
                'specialite' => $specialite
            ] ,200);
        } else {
            return response() -> json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été ajouté'
            ]);
        }
    }

    public function update(specialite_request $request, $id) {
        $specialite = Specialite::find($id);
        if($specialite != null){
            $specialite -> intitule = $request['intitule'];
            $specialite -> save();

            event(new ModelUpdated($specialite));

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
            event(new ModelDeleted($specialite));
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
