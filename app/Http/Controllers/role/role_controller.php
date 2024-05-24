<?php

namespace App\Http\Controllers\role;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\role\role_request;
use App\Models\Role;
use Illuminate\Http\Request;

class role_controller extends Controller
{
    public function index() {
        $role=Role::where('intitule', '!=', 'Eleve') ->distinct()->orderBy('created_at', 'desc')->get();
        if($role!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$role
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Auncune donnée trouvée',
            ],500 );
        }
     }

     public function all_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $classe=Role::orderBy('created_at', 'desc')->paginate($perPage);
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function get_last_value() {
        $classe=Role::orderBy('created_at', 'desc')->take(5)->get();
        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(role_request $request){
        $data=$request->validated();
        $role=Role::create($data);
        if($role!=null){
            event(new ModelCreated($role));
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
    public function update(role_request $request, $id){
        $role=role::find($id);
        if($role!=null){
           $role->intitule=$request['intitule'];
           $role->categorie_personnel=$request['categorie_personnel'];

           $role->save();
           event(new ModelUpdated($role));
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
    public function delete($id){
        $role=role::find($id);
        if($role!=null){
            $role->delete();
            event(new ModelDeleted($role));
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
                'message'=>'Ce role n\'existe pas',
            ],500 );
        }

    }
    public function all() {
        $role=Role::orderBy('created_at', 'desc')->get();
        if($role!=null){
            return response()->json([
                'statut'=>200,
                'role'=>$role
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Auncune donnée trouvée',
            ],500 );
        }
     }
}
