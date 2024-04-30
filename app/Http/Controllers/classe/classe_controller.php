<?php

namespace App\Http\Controllers\classe;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\classe\classe_request;
use App\Models\Classe;
use Illuminate\Http\Request;

class classe_controller extends Controller
{
    public function all() {
        $classe=Classe::with('unite_de_formation', 'type_formation')->orderBy('created_at', 'desc')->get();
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function all_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $classe=Classe::with('unite_de_formation', 'type_formation')->orderBy('created_at', 'desc')->paginate($perPage);
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function get_last_value() {
        $classe=Classe::with('unite_de_formation', 'type_formation')->orderBy('created_at', 'desc')->take(5)->get();
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(classe_request $request){
        $data=$request->validated();

        $verification =Classe::where([['nom_classe','=', $request['nom_classe']],['type_classe','=', $request['type_classe']],['niveau','=', $request['niveau']]])->get();

        if($verification->count()!=0){
            return response()->json([
                'statut'=>404,
                'message'=>'Cette classe existe déja',
            ],404 );
        }else{
        $classe=Classe::create($data);
        if($classe!=null){
        event(new ModelCreated($classe));
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
}
    public function update(classe_request $request, $id){
        $classe=classe::find($id);
        if($classe!=null){
            $request->validated();
           $classe->type_classe=$request['type_classe'];
           $classe->nom_classe=$request['nom_classe'];
           $classe->id_type_formation=$request['id_type_formation'];
           $classe->id_unite_de_formation=$request['id_unite_de_formation'];
           $classe->niveau=$request['niveau'];

           $classe->save();
           event(new ModelUpdated($classe));
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
            event(new ModelDeleted($classe));
            return response()->json([
                'statut'=>200,
                'message'=>'La classe a été supprimé avec succes',
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La classe n\'a pas été supprimé',
            ],500 );
        }

    }

    public function show($id){
        $classe=classe::with('unite_de_formation', 'type_formation')->find($id);
   
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Classe n\'a pas été trouvé',
            ],500 );
        }

    }
}
