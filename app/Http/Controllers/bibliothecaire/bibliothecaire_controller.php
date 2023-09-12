<?php

namespace App\Http\Controllers\bibliothecaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class bibliothecaire_controller extends Controller
{
    
    public function index() {
        $bibliothecaire=bibliothecaire::all();
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
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
            'nom_bibliothecaire'=>'required',
        ]);
        $bibliothecaire=bibliothecaire::create($data);
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function mis_ajour(Request $request, $id){
        $bibliothecaire=bibliothecaire$bibliothecaire::find($id);
        if($bibliothecaire!=null){
           $bibliothecaire->nom_bibliothecaire=$request['nom_bibliothecaire'];
           
           $bibliothecaire->save();
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $bibliothecaire=bibliothecaire::find($id);
        if($bibliothecaire!=null){
            $bibliothecaire->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'bibliothecaire supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'bibliothecaire n\'est pas supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $bibliothecaire=bibliothecaire::find($id);
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'bibliothecaire n\'existe pas ',
            ],500 );
        }
    }

}
