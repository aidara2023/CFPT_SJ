<?php

namespace App\Http\Controllers\retard;

use App\Http\Controllers\Controller;
use App\Models\Retard;
use Illuminate\Http\Request;

class retard_controller extends Controller
{
    public function index() {
        $retard=Retard::all();
        if($retard!=null){
            return response()->json([
                'statut'=>200,
                'retard'=>$retard
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
            'date'=>'required',
            'heure'=>'required',
            'id_eleve'=>'required',
            'id_cour'=>'required'
            
           
        ]);
        $retard=Retard::create($data);
        if($retard!=null){
            return response()->json([
                'statut'=>200,
                'retard'=>$retard
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $retard=retard::find($id);
        if($retard!=null){
           $retard->date=$request['date'];
           $retard->id_eleve=$request['id_eleve'];
           $retard->id_cour=$request['id_cour'];
          
           $retard->save();
            return response()->json([
                'statut'=>200,
                'retard'=>$retard
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $retard=Retard::find($id);
        if($retard!=null){
            $retard->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'La retard supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La retard n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $retard=Retard::find($id);
        if($retard!=null){
            return response()->json([
                'statut'=>200,
                'retard'=>$retard
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'retard n\'a pas été éffectué',
            ],500 );
        }
       
    }
}