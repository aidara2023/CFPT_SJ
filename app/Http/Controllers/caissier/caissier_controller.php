<?php

namespace App\Http\Controllers\caissier;


use App\Http\Controllers\Controller;
use App\Http\Requests\caissier\caissier_request;
use App\Models\Caissier;
use App\Models\User;
use Illuminate\Http\Request;



class caissier_controller extends Controller
{
    public function index(){

        $data = Caissier::all();
        return response()->json($data);
    }
    public function store(caissier_request $request){
        $validatedData = $request->validated();

        $user=User::create($validatedData);
        $caissier=Caissier::create([
            'id_service'=>$request['id_service'],
            'id_user'=>$user->id
        ]);

        if($caissier!=null){
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
        
    }

    public function update(caissier_request $request, $id){
        $caissier=Caissier::find($id);
        if($caissier!=null){
           $caissier->id_service=$request['id_service']; 
           $caissier->id_user=$request['id_user'];
           $caissier->save();
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $caissier=Caissier::find($id);
        if($caissier!=null){
            $caissier->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'caissier supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'caissier non supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $caissier=Caissier::find($id);
        if($caissier!=null){
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'caissier n\'existe pas ',
            ],500 );
        }
    }
}
