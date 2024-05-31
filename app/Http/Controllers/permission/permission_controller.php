<?php

namespace App\Http\Controllers\permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class permission_controller extends Controller
{
    public function index() {
        $permission=Permission::with('fonctionnalite', 'role')->orderBy('created_at', 'desc')->get();
        if($permission!=null){
            return response()->json([
                'statut'=>200,
                'permission'=>$permission
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucune donnée trouvée',
            ],500 );
        }
     }

     public function all_paginate(Request $request){

        $perPage = $request->has('per_page') ? $request->per_page : 15;
        $permission = Permission::with('fonctionnalite', 'role')->orderBy('created_at', 'desc')->paginate($perPage);
        if($permission != null){
            return response()->json([
                'statut' => 200,
                'permission' => $permission
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }

     public function store (Request $request){
        $data=$request->validated();
        $permission=Permission::create($data);
        if($permission!=null){
            return response()->json([
                'statut'=>200,
                'permission'=>$permission
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }

    public function get_five_laste(){
        $permission = Permission::with('fonctionnalite', 'role')->orderBy('created_at', 'desc')->take(5)->get();
        if($permission != null){
            return response()->json([
                'statut' => 200,
                'permission' => $permission
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }


    public function update(Request $request, $id){
        $permission=Permission::find($id);
        if($permission!=null){
           $permission->read=$request['read'];
           $permission->create=$request['create'];
           $permission->update=$request['update'];
           $permission->delete=$request['delete'];
           $permission->id_role=$request['id_role'];
           $permission->id_fonctionnalite=$request['id_fonctionnalite'];
           $permission->save();
            return response()->json([
                'statut'=>200,
                'permission'=>$permission
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function destroy($id){
        $permission=Permission::find($id);
        if($permission!=null){
            $permission->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Le lien a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression du lien',
            ],500 );
        }
       
    }

    public function show($id){
        $permission=Permission::find($id);
        if($permission!=null){
            return response()->json([
                'statut'=>200,
                'permission'=>$permission
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La matiere n\'existe pas ',
            ],500 );
        }
       
    }
}
