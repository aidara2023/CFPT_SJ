<?php

namespace App\Http\Controllers\classe_matiere;

use App\Http\Controllers\Controller;
use App\Models\ClasseMatiere;
use Illuminate\Http\Request;

class classe_matiere_controller extends Controller
{
    public function index() {
        $classematiere=ClasseMatiere::with('classe', 'matiere')->orderBy('created_at', 'desc')->get();
        if($classematiere!=null){
            return response()->json([
                'statut'=>200,
                'classematiere'=>$classematiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune donnée trouvée',
            ],500 );
        }
     }

     public function get_five_laste(){
        $classematiere = ClasseMatiere::with('classe', 'matiere')->orderBy('created_at', 'desc')->take(5)->get();
        if($classematiere != null){
            return response()->json([
                'statut' => 200,
                'classematiere' => $classematiere
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
        $classematiere = ClasseMatiere::with('classe', 'matiere')->orderBy('created_at', 'desc')->paginate($perPage);
        if($classematiere != null){
            return response()->json([
                'statut' => 200,
                'classematiere' => $classematiere
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }

     public function store (Request $request){
        $data=$request->validated();
        $classematiere=ClasseMatiere::create($data);
        if($classematiere!=null){
            return response()->json([
                'statut'=>200,
                'classematiere'=>$classematiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(Request $request, $id){
        $classematiere=ClasseMatiere::find($id);
        if($classematiere!=null){
           $classematiere->id_classe=$request['id_classe'];
           $classematiere->id_matiere=$request['id_matiere'];
           $classematiere->save();
            return response()->json([
                'statut'=>200,
                'classematiere'=>$classematiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function destroy($id){
        $classematiere=ClasseMatiere::find($id);
        if($classematiere!=null){
            $classematiere->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Le lien a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression du lien',
            ],500 );
        }
       
    }


    public function show($id){
        $classematiere=ClasseMatiere::with('classe', 'matiere')->find($id);
        if($classematiere!=null){
            return response()->json([
                'statut'=>200,
                'classematiere'=>$classematiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La matiere n\'existe pas ',
            ],500 );
        }
       
    }
}
