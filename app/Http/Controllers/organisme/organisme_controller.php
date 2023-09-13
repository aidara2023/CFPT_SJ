<?php

namespace App\Http\Controllers\organisme;

use App\Http\Controllers\Controller;
use App\Models\Organisme;
use Illuminate\Http\Request;

class organisme_controller extends Controller
{
    public function index() {
        $organisme=Organisme::all();
        if($organisme!=null){
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,  
                'message'=>'aucun nom d organisme  n\'a été enregistrée',
            ],500 );
        }
     }

     public function store (Request $request){
        $data=$request->validate([
            'intitule_organisme'=>'required'
                ]);
        $organisme=Organisme::create($data);
        if($organisme!=null){
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(Request $request, $id){
        $organisme=Organisme::find($id);
        if($organisme!=null){
           $organisme->intitule=$request['intitule'];
           $organisme->save();
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $organisme=Organisme::find($id);
        if($organisme!=null){
            $organisme->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'L\'organisme a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression de l\'Organisme',
            ],500 );
        }
       
    }


    public function show($id){
        $organisme=Organisme::find($id);
        if($organisme!=null){
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'organisme n\'existe pas ',
            ],500 );
        }
       
    }
}
