<?php

namespace App\Http\Controllers\livre;

use App\Http\Controllers\Controller;
use App\Http\Requests\livre\livre_request;
use App\Models\Livre;
use Illuminate\Http\Request;

class livre_controller extends Controller
{
    
    public function index() {
        $livre=Livre::orderBy('created_at', 'desc')->get();
        if($livre!=null){
            return response()->json([
                'statut'=>200,
                'livre'=>$livre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function store (livre_request $request){
        $data=$request->validated();
        $livre=Livre::create($data);
        if($livre!=null){
            return response()->json([
                'statut'=>200,
                'livre'=>$livre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(livre_request $request, $id){
        $livre=Livre::find($id);
        if($livre!=null){
           $livre->titre_livre=$request['titre_livre'];
           $livre->id_categorie=$request['id_categorie'];
           $livre->id_auteur=$request['id_auteur'];
           $livre->id_edition=$request['id_edition'];
           $livre->save();
            return response()->json([
                'statut'=>200,
                'livre'=>$livre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function delete($id){
        $livre=livre::find($id);
        if($livre!=null){
            $livre->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'livre supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Livre non supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $livre=livre::find($id);
        if($livre!=null){
            return response()->json([
                'statut'=>200,
                'livre'=>$livre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Ce livre n\'existe pas ',
            ],500 );
        }
    }
}
