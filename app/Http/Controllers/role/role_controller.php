<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class role_controller extends Controller
{
    public function index() {
        $role=Role::all();
        if($role!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$role
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
           
        ]);
        $role=Role::create($data);
        if($role!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$role
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $role=role::find($id);
        if($role!=null){
           $role->intitule=$request['intitule'];
          
           $role->save();
            return response()->json([
                'statut'=>200,
                'role'=>$role
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $role=role::find($id);
        if($role!=null){
            $role->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Role supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le role n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $role=Role::find($id);
        if($role!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$role
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Role n\'a pas été éffectué',
            ],500 );
        }
       
    }
}