<?php

namespace App\Http\Controllers\matiere;

use App\Http\Controllers\Controller;
use App\Http\Requests\matiere\matiere_request;
use Illuminate\Http\Request;
use App\Models\Matiere;

class matiere_controller extends Controller
{
    public function index() {
        $matiere=Matiere::all();
        if($matiere!=null){
            return response()->json([
                'statut'=>200,
                'matiere'=>$matiere
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune matiere  n\'a été enregistrée',
            ],500 );
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

}
