<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Formateur;
use Illuminate\Http\Request;

class formateurController extends Controller
{
    public function index() {
        $formateur=Formateur::all();
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }

    public function ajouter (Request $request){
        $data=$request->validate([
            'type'=>'required',,
            'Situation_matrimoniale'=>'required',,
            'id_specialite'=>'required',,
            'id_departement'=>'required',
            'id_user'=>'required',
           
        ]);
        $formateur=Formateur::create($data);
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function mis_ajour(Request $request, $id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
           $formateur->type=$request['nom'];
           $formateur->Situation_matrimoniale=$request['Situation_matrimoniale'];
           $formateur->genre=$request['id_specialite'];
           $formateur->adresse=$request['id_departement'];
           $formateur->telephone=$request['id_user'];
          
           $formateur->save();
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
            $formateur->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Formateur supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le formateur n\'est pas supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le formateur n\'existe pas',
            ],500 );
        }
       
    }
}
