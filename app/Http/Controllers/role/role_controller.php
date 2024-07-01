<?php

namespace App\Http\Controllers\role;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\role\role_request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $classe=Role::with('permissions')->orderBy('created_at', 'desc')->paginate($perPage);
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
        $data = $request->validated();
        $permissions = json_decode($request->input('permis'), true);

        $roledata = [
            'intitule' => $data['intitule'],
            'categorie_personnel' => $data['categorie_personnel'],
        ];
        $role = Role::create($roledata);
        event(new ModelCreated($role));
    
        foreach ($permissions as $permission) {
            $permi = [
                'id_role' => $role['id'],
                'id_fonctionnalite' => $permission['id_fonctionnalite'],
                'read' => $permission['read'],
                'update' => $permission['update'],
                'create' => $permission['create'],
                'delete' => $permission['delete'],
            ];
    
            $rolepermi = Permission::create($permi);
            event(new ModelCreated($rolepermi));
        }
    
        if(isset($role) && isset($rolepermi)){
            return response()->json([
                'statut'=>200,
                'role'=>$role
            ],200);
        } else {
            return response()->json([
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été effectué',
            ],500);
        }
    }
    


/*     public function update(role_request $request, $id){
        $role=role::find($id);
        if($role!=null){

            $data = $request->validated();
            $permissions = json_decode($request->input('permis'), true);

            $role->intitule=$data['intitule'];
            $role->categorie_personnel=$data['categorie_personnel'];
            $role->save();
 
            event(new ModelUpdated($role));
        
            foreach ($permissions as $permission) {
                $permis=Permission::find($permission['id']);
    
               $permis->id_fonctionnalite = $permission['id_fonctionnalite'];
                   $permis->read = $permission['read'];
                   $permis->update = $permission['update'];
                   $permis->create = $permission['create'];
                   $permis->delete = $permission['delete'];

                   $permis->save();

                event(new ModelUpdated($permis));
            }
            return response()->json([
                'statut' => 200,
                'role' => $role
            ], 200);
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    } */
   

public function update(role_request $request, $id)
{
    $role = Role::find($id);
    if ($role) {
        $data = $request->validated();
        $permissions = json_decode($request->input('permis'), true);

        DB::beginTransaction();

        try {
            // Mise à jour du rôle
            $role->intitule = $data['intitule'];
            $role->categorie_personnel = $data['categorie_personnel'];
            $role->save();

            event(new ModelUpdated($role));

            // Mise à jour des permissions
            foreach ($permissions as $permission) {
                $permis = Permission::find($permission['id']);
                if(""===$permission['id']){
                    $nouvellepermission= new Permission();
                    $nouvellepermission->id_role = $role->id;
                    $nouvellepermission->id_fonctionnalite = $permission['id_fonctionnalite'];
                    $nouvellepermission->read = $permission['read'];
                    $nouvellepermission->update = $permission['update'];
                    $nouvellepermission->create = $permission['create'];
                    $nouvellepermission->delete = $permission['delete'];
                    $nouvellepermission->save();

                    event(new ModelCreated($nouvellepermission));

                } else{
                    if ($permis) {
                        $permis->id_fonctionnalite = $permission['id_fonctionnalite'];
                        $permis->read = $permission['read'];
                        $permis->update = $permission['update'];
                        $permis->create = $permission['create'];
                        $permis->delete = $permission['delete'];
                        $permis->save();
    
                        event(new ModelUpdated($permis));
                    }
                    else {
                        // Gérer le cas où la permission n'existe pas
                        return response()->json([
                            'statut' => 404,
                            'message' => 'Permission non trouvée : ' . $permission['id'],
                        ], 404);
                    }
                }
               
            }

            DB::commit();

            return response()->json([
                'statut' => 200,
                'role' => $role
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage(),
            ], 500);
        }
    } else {
        return response()->json([
            'statut' => 404,
            'message' => 'Rôle non trouvé',
        ], 404);
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
