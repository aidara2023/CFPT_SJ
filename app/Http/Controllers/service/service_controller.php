<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class service_controller extends Controller
{
    public function index() {
        $service=Service::all();
        if($service!=null){
            return response()->json([
                'statut'=>200,
                'service'=>$service
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }

    public function store(Request $request){
        $data=$request->validate([
            'intitule'=>'required',
            'nom_service'=>'required',
            'id_user'=>'required'
           
        ]);
        $service=Service::create($data);
        if($service!=null){
            return response()->json([
                'statut'=>200,
                'service'=>$service
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $service=Service::find($id);
        if($service!=null){
           $service->intitule=$request['intitule'];
           $service->nom_service=$request['nom_service'];
           $service->id_user=$request['id_user'];
          
           $service->save();
            return response()->json([
                'statut'=>200,
                'service'=>$service
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $service=Service::find($id);
        if($service!=null){
            $service->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'service supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La service n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $service=Service::find($id);
        if($service!=null){
            return response()->json([
                'statut'=>200,
                'service'=>$service
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'service n\'a pas été éffectué',
            ],500 );
        }
       
    }
}
