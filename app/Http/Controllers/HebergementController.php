<?php

namespace App\Http\Controllers;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Models\Hebergement;
use Illuminate\Http\Request;

class HebergementController extends Controller
{
    public function index_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $hebergement=Hebergement::with('chambre.batiment', 'eleve.user', 'eleve.inscription.classe')->orderBy('created_at', 'desc')->paginate($perPage);
        if($hebergement!=null){
            return response()->json([
                'statut'=>200,
                'hebergement'=>$hebergement
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function index() {
        $hebergement=hebergement::with('batiment', 'eleve.user', 'eleve.classe')->orderBy('created_at', 'desc')->get();
        if($hebergement!=null){
            return response()->json([
                'statut'=>200,
                'hebergement'=>$hebergement
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function get_last_values() {
        $hebergement=hebergement::with('batiment', 'eleve.user', 'eleve.classe')->orderBy('created_at', 'desc')->take(5)->get();
        if($hebergement!=null){
            return response()->json([
                'statut'=>200,
                'hebergement'=>$hebergement
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

    public function store(Request $request){

        /* 'id_eleve',
        'id_chambre',
        'quotient',
        'id_annee', */
        
        $hebergement=new hebergement();
        $hebergement->id_eleve= $request->id_eleve;
        $hebergement->id_chambre= $request->id_chambre;
        $hebergement->id_eleve= $request->id_eleve;
        $hebergement->quotient= $request->quotient;
        $hebergement->id_annee= $request->id_annee;
        $hebergement->save();

        if($hebergement!=null){
            event(new ModelCreated($hebergement));
            return response()->json([
                'statut'=>200,
                'hebergement'=>$hebergement
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $hebergement=hebergement::find($id);
        if($hebergement!=null){
            $hebergement->id_eleve= $request->id_eleve;
            $hebergement->id_chambre= $request->id_chambre;
            $hebergement->id_eleve= $request->id_eleve;
            $hebergement->quotient= $request->quotient;
            $hebergement->id_annee= $request->id_annee;
          
           $hebergement->save();
           event(new ModelUpdated($hebergement));
            return response()->json([
                'statut'=>200,
                'hebergement'=>$hebergement
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $hebergement=hebergement::find($id);
        if($hebergement!=null){
            $hebergement->delete();
            event(new ModelDeleted($hebergement));
            return response()->json([
                'statut'=>200,
                'message'=>'La hebergement est supprimeé avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La hebergement n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $hebergement=hebergement::find($id);
        if($hebergement!=null){
            return response()->json([
                'statut'=>200,
                'hebergement'=>$hebergement
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La hebergement n\'existe pas ',
            ],500 );
        }
       
    }
}
