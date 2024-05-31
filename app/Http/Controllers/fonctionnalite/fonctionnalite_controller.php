<?php

namespace App\Http\Controllers\fonctionnalite;

use App\Http\Controllers\Controller;
use App\Models\Fonctionnalite;
use Illuminate\Http\Request;

class fonctionnalite_controller extends Controller
{
    public function index() {
        $fonctionnalite=Fonctionnalite::orderBy('created_at', 'desc')->get();
        if($fonctionnalite!=null){
            return response()->json([
                'statut'=>200,
                'fonctionnalite'=>$fonctionnalite
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune donnée trouvée',
            ],500 );
        }
     }
     public function get_five_laste(){
        $fonctionnalite = Fonctionnalite::orderBy('created_at', 'desc')->take(5)->get();
        if($fonctionnalite != null){
            return response()->json([
                'statut' => 200,
                'fonctionnalite' => $fonctionnalite
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
        $fonctionnalite = Fonctionnalite::orderBy('created_at', 'desc')->paginate($perPage);
        if($fonctionnalite != null){
            return response()->json([
                'statut' => 200,
                'fonctionnalite' => $fonctionnalite
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }

     public function store (Request $request){
        
        $fonctionnalite=new Fonctionnalite();
        $fonctionnalite->intitule=$request->intitule;
        $fonctionnalite->save();
        if($fonctionnalite!=null){
            return response()->json([
                'statut'=>200,
                'fonctionnalite'=>$fonctionnalite
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(Request $request, $id){
        $fonctionnalite=Fonctionnalite::find($id);
        if($fonctionnalite!=null){
           $fonctionnalite->intitule=$request['intitule'];
           $fonctionnalite->save();
            return response()->json([
                'statut'=>200,
                'fonctionnalite'=>$fonctionnalite
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function destroy($id){
        $fonctionnalite=Fonctionnalite::find($id);
        if($fonctionnalite!=null){
            $fonctionnalite->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'La fonctionnalite a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression du lien',
            ],500 );
        }
       
    }


    public function show($id){
        $fonctionnalite=Fonctionnalite::find($id);
        if($fonctionnalite!=null){
            return response()->json([
                'statut'=>200,
                'fonctionnalite'=>$fonctionnalite
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La fonctionnalite n\'existe pas ',
            ],500 );
        }
       
    }
}
