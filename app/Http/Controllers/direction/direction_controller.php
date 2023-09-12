<?php

namespace App\Http\Controllers\direction;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Http\Request;

class direction_controller extends Controller
{
    public function index() {
        $direction=Direction::all();
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }

    public function store(Request $request){
        $data=$request->validate([
            'intitule'=>'required',
            'nom_direction'=>'required',
            'id_user'=>'required'
           
        ]);
        $direction=Direction::create($data);
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $direction=Direction::find($id);
        if($direction!=null){
           $direction->intitule=$request['intitule'];
           $direction->nom_direction=$request['nom_direction'];
           $direction->id_user=$request['id_user'];
          
           $direction->save();
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $direction=Direction::find($id);
        if($direction!=null){
            $direction->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Direction supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La direction n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $direction=Direction::find($id);
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Direction n\'a pas été éffectué',
            ],500 );
        }
       
    }
}
