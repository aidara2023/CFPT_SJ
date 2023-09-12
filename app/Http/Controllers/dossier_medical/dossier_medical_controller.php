<?php

namespace App\Http\Controllers\dossier_medical;

use App\Http\Controllers\Controller;
use App\Models\Dossier_medical;
use Illuminate\Http\Request;

class dossier_medical_controller extends Controller
{
    public function index() {
       $dossier_medical=Dossier_medical::all();
        if($dossier_medical!=null){
            return response()->json([
                'statut'=>200,
                'dossier_medical'=>$organisme
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
       $dossier_medical=Organisme::create($data);
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
       $dossier_medical=Organisme::find($id);
        if($organisme!=null){
          $dossier_medical->intitule=$request['intitule'];
          $dossier_medical->save();
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
       $dossier_medical=Organisme::find($id);
        if($organisme!=null){
           $dossier_medical->delete();
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
       $dossier_medical=Organisme::find($id);
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
