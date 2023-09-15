<?php

namespace App\Http\Controllers\date_emprunter;

use App\Http\Controllers\Controller;
use App\Http\Requests\date_emprunter\date_emprunter_request;
use App\Models\Date_emprunter;
use Illuminate\Http\Request;

class date_emprunter_controller extends Controller
{
    public function index() {
        $date_emprunter=Date_emprunter::all();
        if($date_emprunter!=null){
            return response()->json([
                'statut'=>200,
                'date_emprunter'=>$date_emprunter
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }
    public function store (date_emprunter_request $request){
        $data=$request->validated();
        $date_emprunter=Date_emprunter::create($data);
        if($date_emprunter!=null){
            return response()->json([
                'statut'=>200,
                'date_emprunter'=>$date_emprunter
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(date_emprunter_request $request, $id){
        $date_emprunter=Date_emprunter::find($id);
        if($date_emprunter!=null){
           $date_emprunter->intitule=$request['intitule'];
           
           $date_emprunter->save();
            return response()->json([
                'statut'=>200,
                'date_emprunter'=>$date_emprunter
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function delete($id){
        $date_emprunter=Date_emprunter::find($id);
        if($date_emprunter!=null){
            $date_emprunter->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'date_emprunter supprimée avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La date_emprunter n\'est pas supprimée',
            ],500 );
        }
       
    }
    
    public function show($id){
        $date_emprunter=Date_emprunter::find($id);
        if($date_emprunter!=null){
            return response()->json([
                'statut'=>200,
                'date_emprunter'=>$date_emprunter
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'date_emprunter n\'existe pas ',
            ],500 );
        }
    }
}
