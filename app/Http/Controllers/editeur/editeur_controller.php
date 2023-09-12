<?php

namespace App\Http\Controllers\editeur;

use App\Http\Controllers\Controller;
use App\Models\Editeur;
use Illuminate\Http\Request;

class editeur_controller extends Controller
{
    
    public function index() {
        $editeur=Editeur::all();
        if($editeur!=null){
            return response()->json([
                'statut'=>200,
                'editeur'=>$editeur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }
    public function store (Request $request){
        $data=$request->validate([
            'nom_editeur'=>'required',
        ]);
        $editeur=Editeur::create($data);
        if($editeur!=null){
            return response()->json([
                'statut'=>200,
                'editeur'=>$editeur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'editeur n\'a pas été ajouté',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $editeur=Editeur::find($id);
        if($editeur!=null){
           $editeur->nom_editeur=$request['nom_editeur'];
           
           $editeur->save();
            return response()->json([
                'statut'=>200,
                'editeur'=>$editeur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $editeur=editeur::find($id);
        if($editeur!=null){
            $editeur->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'editeur supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'editeur n\'est pas supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $editeur=editeur::find($id);
        if($editeur!=null){
            return response()->json([
                'statut'=>200,
                'editeur'=>$editeur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'editeur n\'existe pas ',
            ],500 );
        }
    }
}
