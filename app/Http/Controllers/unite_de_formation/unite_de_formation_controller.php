<?php

namespace App\Http\Controllers\unite_de_formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\unite_de_formation\unite_de_formation_request;
use App\Models\Role;
use App\Models\Unite_de_formation;
use App\Models\User;
use Illuminate\Http\Request;

class unite_de_formation_controller extends Controller
{
    public function all() {
        $unite_de_formation=Unite_de_formation::with('departement' , 'user')->get();
        if($unite_de_formation!=null){
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
     public function index (){
        $roles = Role::where('intitule', ['Formateur'])->get();
        if ($roles->isNotEmpty()) {
            $users = User::whereIn('id_role', $roles->pluck('id'))->with('role')->get();

            if ($users->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'user' => $users,
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Aucun utilisateur trouvé pour les rôles spécifiés.',
                ], 500);
            }
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Aucun rôle "Formateur" trouvé.',
            ],500);
        }
     }

     public function store (unite_de_formation_request $request){
        $data=$request->validated();
        $verification =Unite_de_formation::where('nom_unite_formation', $request['nom_unite_formation'])->get();
       
        if($verification->count()!=0){
            return response()->json([ 
                'statut'=>404,
                'message'=>'Cette unite de formation existe déja',
            ],404 );
        }else{
        $unite_de_formation=Unite_de_formation::create($data);
        if($unite_de_formation!=null){
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
     }

    public function update(unite_de_formation_request $request, $id){
        $unite_de_formation=Unite_de_formation::find($id);
        if($unite_de_formation!=null){
           $unite_de_formation->nom_unite_formation=$request['nom_unite_formation'];
           $unite_de_formation->id_user=$request['id_user'];
           $unite_de_formation->id_departement=$request['id_departement'];
           $unite_de_formation->save();
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $unite_de_formation=Unite_de_formation::find($id);
        if($unite_de_formation!=null){
            $unite_de_formation->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'L\'unite de formation a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Echec suppression de l\'unite de formation',
            ],500 );
        }

    }


    public function show($id){
        $unite_de_formation=Unite_de_formation::find($id);
        if($unite_de_formation!=null){
            return response()->json([
                'statut'=>200,
                'unite_de_formation'=>$unite_de_formation
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'L\'unite_de_formation n\'existe pas ',
            ],500 );
        }

    }
}
