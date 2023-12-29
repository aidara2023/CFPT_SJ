<?php

namespace App\Http\Controllers\semestre;

use App\Http\Controllers\Controller;
use App\Models\Semestre;
use Illuminate\Http\Request;

class semestre_controller extends Controller
{
    public function index() {
        $semestre=Semestre::orderBy('created_at', 'desc')->get();
        if($semestre!=null){
            return response()->json([
                'statut'=>200,
                'semestre'=>$semestre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune donnée trouvée',
            ],500 );
        }
     }

     


   


    public function show($id){
        $semestre=Semestre::find($id);
        if($semestre!=null){
            return response()->json([
                'statut'=>200,
                'semestre'=>$semestre
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La semestre n\'existe pas ',
            ],500 );
        }
       
    }

}

