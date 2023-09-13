<?php

namespace App\Http\Controllers\classe;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use Illuminate\Http\Request;

class classe_controller extends Controller
{
    public function index() {
        $classe=Classe::all();
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
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
            'type_classe'=>'required',
            'nom_classe'=>'required',
            'niveau'=>'required',
            'id_type_formation'=>'required',
            'id_unite_de_formation'=>'required'
           
        ]);
        $classe=Classe::create($data);
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $classe=classe::find($id);
        if($classe!=null){
           $classe->type_classe=$request['type_classe'];
           $classe->nom_classe=$request['nom_classe'];
           $classe->id_type_formation=$request['id_type_formation'];
           $classe->id_unite_de_formation=$request['id_unite_de_formation'];
           $classe->niveau=$request['niveau'];
          
           $classe->save();
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $classe=classe::find($id);
        if($classe!=null){
            $classe->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'La classe supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La classe n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $classe=classe::find($id);
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Classe n\'a pas été éffectué',
            ],500 );
        }
       
    }
}
