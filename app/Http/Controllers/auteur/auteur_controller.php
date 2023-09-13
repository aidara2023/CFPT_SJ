<?php

namespace App\Http\Controllers\auteur;

use App\Http\Controllers\Controller;
use App\Models\Auteur;
use Illuminate\Http\Request;

class auteur_controller extends Controller
{ public function index() {
    $auteur=Auteur::all();
    if($auteur!=null){
        return response()->json([
            'statut'=>200,
            'auteur'=>$auteur
        ],200)  ;
    }else{
        return response()->json([ 
            'statut'=>500,
            'message'=>'aucun donner trouver',
        ],500 );
    }
 }
public function store (Request $request){
    $data=$request->validate([
        'nom_auteur'=>'required',
    ]);
    $auteur=Auteur::create($data);
    if($auteur!=null){
        return response()->json([
            'statut'=>200,
            'auteur'=>$auteur
        ],200)  ;
    }else{
        return response()->json([ 
            'statut'=>500,
            'message'=>'L\'enregistrement n\'a pas été éffectué',
        ],500 );
    }
}
public function mis_ajour(Request $request, $id){
    $auteur=Auteur::find($id);
    if($auteur!=null){
       $auteur->nom_auteur=$request['nom_auteur'];
       
       $auteur->save();
        return response()->json([
            'statut'=>200,
            'auteur'=>$auteur
        ],200)  ;
    }else{
        return response()->json([ 
            'statut'=>500,
            'message'=>'La mise à jour n\'a pas été éffectué',
        ],500 );
    }
}
public function supprimer($id){
    $auteur=Auteur::find($id);
    if($auteur!=null){
        $auteur->delete();
        return response()->json([
            'statut'=>200,
            'message'=>'Auteur supprimé avec succés',
        ],200)  ;
    }else{
        return response()->json([ 
            'statut'=>500,
            'message'=>'L\'auteur n\'est pas supprimer',
        ],500 );
    }
   
}

public function show($id){
    $auteur=Auteur::find($id);
    if($auteur!=null){
        return response()->json([
            'statut'=>200,
            'auteur'=>$auteur
        ],200)  ;
    }else{
        return response()->json([ 
            'statut'=>500,
            'message'=>'L\'auteur n\'existe pas ',
        ],500 );
    }
}   
}