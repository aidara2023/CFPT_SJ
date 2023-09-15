<?php

namespace App\Http\Controllers\unite_de_formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\unite_de_formation\unite_de_formation_request;
use App\Models\Unite_de_formation;
use Illuminate\Http\Request;

class unite_de_formation_controller extends Controller
{
    public function index() {
        $unite_de_formation=Unite_de_formation::all();
        if($unite_de_formation!=null){
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune unite_de_formation  n\'a été enregistrée',
            ],500 );
        }
     }

     public function store (unite_de_formation_request $request){
        $data=$request->validated();
        $unite_de_formation=Unite_de_formation::create($data);
        if($unite_de_formation!=null){
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(unite_de_formation_request $request, $id){
        $unite_de_formation=Unite_de_formation::find($id);
        if($unite_de_formation!=null){
           $unite_de_formation->nom_unite_de_formation=$request['nom_unite_de_formation'];
           $unite_de_formation->id_user=$request['id_user'];
           $unite_de_formation->save();
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $unite_de_formation=Unite_de_formation::find($id);
        if($unite_de_formation!=null){
            $unite_de_formation->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'L\'unite de formation a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression de l\'unite de formation',
            ],500 );
        }
       
    }


    public function show($id){
        $unite_de_formation=Unite_de_formation::find($id);
        if($unite_de_formation!=null){
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\' unite_de_formation n\'existe pas ',
            ],500 );
        }
       
    }
}
