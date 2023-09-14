<?php

namespace App\Http\Controllers\batiment;

use App\Http\Controllers\Controller;
use App\Models\Batiment;
use Illuminate\Http\Request;

class batiment_controller extends Controller
{
    public function index() {
        $batiment=Batiment::all();
        if($batiment!=null){
            return response()->json([
                'statut'=>200,
                'batiment'=>$batiment
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(Request $request){
        $data=$request->validate([
            'intitule'=>'required',
           
           
        ]);
        $batiment=Batiment::create($data);
        if($batiment!=null){
            return response()->json([
                'statut'=>200,
                'batiment'=>$batiment
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $batiment=Batiment::find($id);
        if($batiment!=null){
           $batiment->intitule=$request['type_batiment'];
          
           $batiment->save();
            return response()->json([
                'statut'=>200,
                'batiment'=>$batiment
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $batiment=Batiment::find($id);
        if($batiment!=null){
            $batiment->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Le batiment est supprimé avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le batiment n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $batiment=Batiment::find($id);
        if($batiment!=null){
            return response()->json([
                'statut'=>200,
                'batiment'=>$batiment
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'batiment n\'a pas été trouvé',
            ],500 );
        }
       
    }
}
