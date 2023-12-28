<?php

namespace App\Http\Controllers;

use App\Http\Requests\alerte\alerte_request;
use App\Models\Alerte;
use Illuminate\Http\Request;

class AlerteController extends Controller
{
    public function index() {
        $alerte=Alerte::orderBy('created_at', 'desc')->get();
        if($alerte!=null){
            return response()->json([
                'statut'=>200,
                'alerte'=>$alerte
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(alerte_request $request){
        $data=$request->validated();
        $alerte=alerte::create($data);
        if($alerte!=null){
            return response()->json([
                'statut'=>200,
                'alerte'=>$alerte
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(alerte_request $request, $id){
        $alerte=alerte::find($id);
        if($alerte!=null){
           $alerte->titre=$request['titre'];
           $alerte->message=$request['message'];
           $alerte->statut=$request['statut'];
           $alerte->id_user=$request['id_user'];
          
           $alerte->save();
            return response()->json([
                'statut'=>200,
                'alerte'=>$alerte
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $alerte=alerte::find($id);
        if($alerte!=null){
            $alerte->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Presence supprimée avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Message d alerte  non supprimée',
            ],500 );
        }
       
    }
}
