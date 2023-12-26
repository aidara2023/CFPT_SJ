<?php

namespace App\Http\Controllers\organisme;

use App\Http\Controllers\Controller;
use App\Http\Requests\organisme\organisme_request;
use App\Models\Organisme;
use Illuminate\Http\Request;

class organisme_controller extends Controller
{
    public function index() {
        $organisme=Organisme::orderBy('created_at', 'desc')->get();
        if($organisme!=null){
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,  
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

     public function store (organisme_request $request){
        $data=$request->validated();
        $organisme=Organisme::create($data);
        if($organisme!=null){
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(organisme_request $request, $id){
        $organisme=Organisme::find($id);
        if($organisme!=null){
           $organisme->nom_organisme=$request['nom_organisme'];
           $organisme->save();
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $organisme=Organisme::find($id);
        if($organisme!=null){
            $organisme->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'L\'organisme a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression de l\'Organisme',
            ],500 );
        }
       
    }


    public function show($id){
        $organisme=Organisme::find($id);
        if($organisme!=null){
            return response()->json([
                'statut'=>200,
                'organisme'=>$organisme
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'organisme n\'existe pas ',
            ],500 );
        }
       
    }
}
