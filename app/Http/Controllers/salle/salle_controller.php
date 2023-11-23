<?php

namespace App\Http\Controllers\salle;

use App\Http\Controllers\Controller;
use App\Http\Requests\salle\salle_request;
use App\Models\Salle;
use Illuminate\Http\Request;

class salle_controller extends Controller
{
    public function index() {
        $salle=Salle::with('batiment')->get();
        if($salle!=null){
            return response()->json([
                'statut'=>200,
                'salle'=>$salle
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

    public function store(salle_request $request){
        $data=$request->validated();
        $salle=Salle::create($data);
        if($salle!=null){
            return response()->json([
                'statut'=>200,
                'salle'=>$salle
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(salle_request $request, $id){
        $salle=salle::find($id);
        if($salle!=null){
           $salle->intitule=$request['intitule'];
           $salle->nombre_place=$request['nombre_place'];
           $salle->id_batiment=$request['id_batiment'];
          
           $salle->save();
            return response()->json([
                'statut'=>200,
                'salle'=>$salle
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $salle=Salle::find($id);
        if($salle!=null){
            $salle->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'La salle est supprimeé avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La salle n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $salle=Salle::find($id);
        if($salle!=null){
            return response()->json([
                'statut'=>200,
                'salle'=>$salle
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La salle n\'existe pas ',
            ],500 );
        }
       
    }
}
