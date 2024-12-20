<?php

namespace App\Http\Controllers\dossier_medical;

use App\Http\Controllers\Controller;
use App\Http\Requests\dossier_medical\dossier_medical_request;
use App\Models\Dossier_medical;
use Illuminate\Http\Request;

class dossier_medical_controller extends Controller
{
    public function index() {
       $dossier_medical=Dossier_medical::orderBy('created_at', 'desc')->get();
        if($dossier_medical!=null){
            return response()->json([
                'statut'=>200,
                'dossier_medical'=>$dossier_medical
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,  
                'message'=>'Aucun  dossier medical  n\'a été enregistré',
            ],500 );
        }
     }

     public function store (dossier_medical_request $request){
        $data=$request->validated();
       $dossier_medical=Dossier_medical::create($data);
        if($dossier_medical!=null){
            return response()->json([
                'statut'=>200,
                'dossier_medical'=>$dossier_medical
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement du dossier medical n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(dossier_medical_request $request, $id){
       $dossier_medical=Dossier_medical::find($id);
        if($dossier_medical!=null){
          $dossier_medical->intitule=$request['id_user'];
          $dossier_medical->save();
            return response()->json([
                'statut'=>200,
                'dossier_medical'=>$dossier_medical
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour du dossier medical n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
       $dossier_medical=Dossier_medical::find($id);
        if($dossier_medical!=null){
           $dossier_medical->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Le dossier_medical a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression du dossier_medical',
            ],500 );
        }
       
    }


    public function show($id){
       $dossier_medical=Dossier_medical::find($id);
        if($dossier_medical!=null){
            return response()->json([
                'statut'=>200,
                'dossier_medical'=>$dossier_medical
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le dossier_medical n\'existe pas ',
            ],500 );
        }
       
    }
}
