<?php

namespace App\Http\Controllers\concerner;

use App\Http\Controllers\Controller;
use App\Http\Requests\concerner\concerner_request;
use App\Models\concerner;
use Illuminate\Http\Request;

class concerner_controller extends Controller
{
     
    public function index() {
        $concerner=concerner::orderBy('created_at', 'desc')->get();
        if($concerner!=null){
            return response()->json([
                'statut'=>200,
                'concerner'=>$concerner
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function store (concerner_request $request){
        $data=$request->validated();
        $concerner=concerner::create($data);
        if($concerner!=null){
            return response()->json([
                'statut'=>200,
                'concerner'=>$concerner
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(concerner_request $request, $id){
        $concerner=concerner::find($id);
        if($concerner!=null){
            $request->validated();
           $concerner->intitule=$request['intitule'];
           
           $concerner->save();
            return response()->json([
                'statut'=>200,
                'concerner'=>$concerner
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function delete($id){
        $concerner=concerner::find($id);
        if($concerner!=null){
            $concerner->delete();
            return response()->json([
                'statut'=>200,
                'message'=>' Suppression réussie',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression',
            ],500 );
        }
       
    }
    
    public function show($id){
        $concerner=concerner::find($id);
        if($concerner!=null){
            return response()->json([
                'statut'=>200,
                'concerner'=>$concerner
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>' n\'existe pas ',
            ],500 );
        }
    }
}
