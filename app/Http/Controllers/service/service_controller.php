<?php

namespace App\Http\Controllers\service;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
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
    public function get_all_services(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;
        
        $service=Service::with('user', 'direction')->orderBy('created_at', 'desc')->paginate($perPage);
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

 
     public function get_five_laste() {
        $services = Service::with('user', 'direction')
            ->orderBy('created_at', 'desc')
            ->take(5) // Ajout de cette ligne pour récupérer les 5 derniers enregistrements
            ->get();
    
        if ($services->count() > 0) {
            return response()->json([
                'statut' => 200,
                'service' => $services
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
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
            event(new ModelCreated($service));
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
           event(new ModelUpdated($service));
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
            event(new ModelDeleted($service));
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
