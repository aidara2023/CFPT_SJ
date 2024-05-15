<?php

namespace App\Http\Controllers;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $chambre=Chambre::with('batiment')->orderBy('created_at', 'desc')->paginate($perPage);
        if($chambre!=null){
            return response()->json([
                'statut'=>200,
                'chambre'=>$chambre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function index() {
        $chambre=Chambre::with('batiment')->orderBy('created_at', 'desc')->get();
        if($chambre!=null){
            return response()->json([
                'statut'=>200,
                'chambre'=>$chambre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function get_last_values() {
        $chambre=Chambre::with('batiment')->orderBy('created_at', 'desc')->take(5)->get();
        if($chambre!=null){
            return response()->json([
                'statut'=>200,
                'chambre'=>$chambre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

    public function store(Request $request){
        
        $chambre=new Chambre();
        $chambre->intitule= $request->intitule;
        $chambre->id_batiment= $request->id_batiment;
        $chambre->save();

        if($chambre!=null){
            event(new ModelCreated($chambre));
            return response()->json([
                'statut'=>200,
                'chambre'=>$chambre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $chambre=Chambre::find($id);
        if($chambre!=null){
           $chambre->intitule=$request['intitule'];
           $chambre->id_batiment=$request['id_batiment'];
          
           $chambre->save();
           event(new ModelUpdated($chambre));
            return response()->json([
                'statut'=>200,
                'chambre'=>$chambre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $chambre=Chambre::find($id);
        if($chambre!=null){
            $chambre->delete();
            event(new ModelDeleted($chambre));
            return response()->json([
                'statut'=>200,
                'message'=>'La chambre est supprimeé avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La chambre n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $chambre=Chambre::find($id);
        if($chambre!=null){
            return response()->json([
                'statut'=>200,
                'chambre'=>$chambre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La chambre n\'existe pas ',
            ],500 );
        }
       
    }
}
