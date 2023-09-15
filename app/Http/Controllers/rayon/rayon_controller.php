<?php

namespace App\Http\Controllers\rayon;

use App\Http\Controllers\Controller;
use App\Http\Requests\rayon\rayon_request;
use App\Models\Rayon;
use Illuminate\Http\Request;

class rayon_controller extends Controller
{
    
    public function index() {
        $rayon=Rayon::all();
        if($rayon!=null){
            return response()->json([
                'statut'=>200,
                'rayon'=>$rayon
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }
    public function store (rayon_request $request){
        $data=$request->validated();
        $rayon=rayon::create($data);
        if($rayon!=null){
            return response()->json([
                'statut'=>200,
                'rayon'=>$rayon
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(rayon_request $request, $id){
        $rayon=Rayon::find($id);
        if($rayon!=null){
           $rayon->intitule=$request['intitule'];
           $rayon->save();
            return response()->json([
                'statut'=>200,
                'rayon'=>$rayon
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $rayon=rayon::find($id);
        if($rayon!=null){
            $rayon->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Rayon supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le rayon n\'est pas supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $rayon=rayon::find($id);
        if($rayon!=null){
            return response()->json([
                'statut'=>200,
                'rayon'=>$rayon
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le rayon n\'existe pas ',
            ],500 );
        }
    }
}
