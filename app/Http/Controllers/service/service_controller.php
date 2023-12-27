<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use App\Http\Requests\service\service_request;
use App\Models\Service;
use Illuminate\Http\Request;

class service_controller extends Controller
{
    public function index() {
        $service=Service::with('user', 'direction')->orderBy('created_at', 'desc')->get();
        if($service!=null){
            return response()->json([
                'statut'=>200,
                'service'=>$service
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

    public function store(service_request $request){
        $data=$request->validated();
        
        $verification =Service::where('nom_service', $request['nom_service'])->get();
       
        if($verification->count()!=0){
            return response()->json([ 
                'statut'=>404,
                'message'=>'Ce service existe déja',
            ],404 );
        }else{
        $service=Service::create($data);
        if($service!=null){
            return response()->json([
                'statut'=>200,
                'service'=>$service
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été ajouté',
            ],500 );
        }
    }
}
    public function update(service_request $request, $id){
        $service=Service::find($id);
        if($service!=null){
           $service->nom_service=$request['nom_service'];
           $service->id_user=$request['id_user'];
           $service->id_direction=$request['id_direction'];
          
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
    public function delete($id){
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
                'message'=>'Le service n\'est pas supprimé',
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
                'message'=>'Service non enregistré',
            ],500 );
        }
       
    }
}
