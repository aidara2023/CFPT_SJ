<?php

namespace App\Http\Controllers\matiere;

use App\Http\Controllers\Controller;
use App\Http\Requests\matiere\matiere_request;
use App\Models\FormateurMatiere;
use Illuminate\Http\Request;
use App\Models\Matiere;

class matiere_controller extends Controller
{
    public function index() {
        $matiere=Matiere::orderBy('created_at', 'desc')->get();
        if($matiere!=null){
            return response()->json([
                'statut'=>200,
                'matiere'=>$matiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune donnée trouvée',
            ],500 );
        }
     }

     public function get_five_laste(){
        $matiere = Matiere::orderBy('created_at', 'desc')->take(5)->get();
        if($matiere != null){
            return response()->json([
                'statut' => 200,
                'matiere' => $matiere
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
        $matiere = Matiere::orderBy('created_at', 'desc')->paginate($perPage);
        if($matiere != null){
            return response()->json([
                'statut' => 200,
                'matiere' => $matiere
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }

     public function store (matiere_request $request){
        $data=$request->validated();
        $matiere=Matiere::create($data);
        if($matiere!=null){
            return response()->json([
                'statut'=>200,
                'matiere'=>$matiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(matiere_request $request, $id){
        $matiere=Matiere::find($id);
        if($matiere!=null){
           $matiere->intitule=$request['intitule'];
           $matiere->duree=$request['duree'];
           $matiere->save();
            return response()->json([
                'statut'=>200,
                'matiere'=>$matiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $matiere=Matiere::find($id);
        if($matiere!=null){
            $matiere->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'La matiére a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression de la matiére',
            ],500 );
        }
       
    }


    public function show($id){
        $matiere=Matiere::find($id);
        if($matiere!=null){
            return response()->json([
                'statut'=>200,
                'matiere'=>$matiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La matiere n\'existe pas ',
            ],500 );
        }
       
    }

    public function find_professeur_assign_to_matiere($id){
        $formateurmatiere=FormateurMatiere::with('formateur.user', 'formateur.specialite')->where('id_matiere', $id)->get();
        if($formateurmatiere!=null){
            return response()->json([
                'statut'=>200,
                'formateurmatiere'=>$formateurmatiere
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune formateur n\'à été assigné a cette matiere',
            ],500 );
        }

    }

}
