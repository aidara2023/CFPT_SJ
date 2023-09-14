<?php

namespace App\Http\Controllers\financer_bourse;

use App\Http\Controllers\Controller;
use App\Models\Financer_bourse;
use Illuminate\Http\Request;

class financer_bourse_controller extends Controller
{
    public function index() {
        $financer_bourse=Financer_bourse::all();
        if($financer_bourse!=null){
            return response()->json([
                'statut'=>200,
                'financer_bourse'=>$financer_bourse
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }
    public function store (Request $request){
        $data=$request->validate([
            'date'=>'required',
            'montant'=>'required',
            'id_organisme'=>'required',
            'id_classe'=>'required',
            'id_eleve'=>'required',
            'id_annee_academique'=>'required'
        ]);
        $financer_bourse=Financer_bourse::create($data);
        if($financer_bourse!=null){
            return response()->json([
                'statut'=>200,
                'financer_bourse'=>$financer_bourse
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $financer_bourse=Financer_bourse::find($id);
        if($financer_bourse!=null){
           $financer_bourse->date=$request['date'];
           $financer_bourse->montant=$request['montant'];
           $financer_bourse->id_eleve=$request['id_eleve'];
           $financer_bourse->id_classe=$request['id_classe'];
           $financer_bourse->id_annee_academique=$request['id_annee_academique'];
           $financer_bourse->save();
            return response()->json([
                'statut'=>200,
                'financer_bourse'=>$financer_bourse
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function supprimer($id){
        $financer_bourse=Financer_bourse::find($id);
        if($financer_bourse!=null){
            $financer_bourse->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'financer_bourse supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'financer_bourse non supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $financer_bourse=Financer_bourse::find($id);
        if($financer_bourse!=null){
            return response()->json([
                'statut'=>200,
                'financer_bourse'=>$financer_bourse
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Ce financer_bourse n\'existe pas ',
            ],500 );
        }
    }
}
