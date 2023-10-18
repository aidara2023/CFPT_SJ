<?php

namespace App\Http\Controllers\mois;

use App\Http\Controllers\Controller;
use App\Http\Requests\mois\mois_request;
use App\Models\mois;
use Illuminate\Http\Request;

class mois_controller extends Controller
{
    public function index() {
        $mois=Mois::all();
        if($mois!=null){
            return response()->json([
                'statut'=>200,
                'mois'=>$mois
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune donnée trouvée',
            ],500 );
        }
     }

     public function store (mois_request $request){
        $data=$request->validated();
        $mois=Mois::create($data);
        if($mois!=null){
            return response()->json([
                'statut'=>200,
                'mois'=>$mois
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(mois_request $request, $id){
        $mois=Mois::find($id);
        if($mois!=null){
           $mois->intitule=$request['intitule'];
           $mois->save();
            return response()->json([
                'statut'=>200,
                'mois'=>$mois
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $mois=Mois::find($id);
        if($mois!=null){
            $mois->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Le mois a été supprimé avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression du mois',
            ],500 );
        }
       
    }


    public function show($id){
        $mois=Mois::find($id);
        if($mois!=null){
            return response()->json([
                'statut'=>200,
                'mois'=>$mois
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Ce mois n\'existe pas ',
            ],500 );
        }
       
    }
}
