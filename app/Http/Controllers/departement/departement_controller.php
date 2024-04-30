<?php

namespace App\Http\Controllers\departement;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\departement\departement_request;
use Illuminate\Http\Request;
use App\Models\Departement;

class departement_controller extends Controller
{
    public function all(){
        $departement = Departement::with('direction' , 'user')->orderBy('created_at', 'desc')->get();
        if($departement != null){
            return response()->json([
                'statut' => 200,
                'departement' => $departement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }
    public function all_paginate(Request $request){

        $perPage = $request->has('per_page') ? $request->per_page : 15;
        $departement = Departement::with('direction' , 'user')->orderBy('created_at', 'desc')->paginate($perPage);
        if($departement != null){
            return response()->json([
                'statut' => 200,
                'departement' => $departement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }
    public function get_five_laste(){
        $departement = Departement::with('direction' , 'user')->orderBy('created_at', 'desc')->take(5)->get();
        if($departement != null){
            return response()->json([
                'statut' => 200,
                'departement' => $departement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }

    public function store(departement_request $request) {
        $data = $request -> validated();
        $verification =Departement::where('nom_departement', $request['nom'])->get();

        if($verification->count()!=0){
            return response()->json([
                'statut'=>404,
                'message'=>'Ce département existe déja',
            ],404 );
        }else{

        /* $departement = Departement::create($data); */
        $departement=new Departement();
        $departement -> nom_departement = $request['nom'];
        $departement -> id_direction = $request['id_direction'];
        $departement -> id_user = $request['id_user'];
        $departement->save();
        if($departement != null){
            event(new ModelCreated($departement));
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
}


    public function update(departement_request $request, $id) {
        $departement = Departement::find($id);
        if($departement != null){
            $departement -> nom_departement = $request['nom'];
            $departement -> id_direction = $request['id_direction'];
            $departement -> id_user = $request['id_user'];
            $departement -> save();

            event(new ModelUpdated($departement));

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

    public function destroy($id) {
        $departement = Departement::find($id);
        if($departement != null){
            $departement -> delete();
            event(new ModelDeleted($departement));
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
