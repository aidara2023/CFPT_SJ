<?php

namespace App\Http\Controllers\tuteur;

use App\Http\Controllers\Controller;
use App\Http\Requests\tuteur\tuteur_request;
use App\Models\Tuteur;
use App\Models\User;
use Illuminate\Http\Request;

class tuteur_controller extends Controller
{
    public function index(){
        $tuteur = Tuteur::all();
        if($tuteur != null){
            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été éffectué'
            ],500);
        }
    }

    public function store(tuteur_request $request) {
        $data = $request -> validated();

        $user = User::create($data);
        $tuteur = Tuteur::create(['id_user' => $user -> id]);

        if($tuteur != null){
            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function update(tuteur_request $request, $id) {
        $tuteur = Tuteur::find($id);
        $user = $tuteur -> id_user;
        $user = User::find($user);
        if($user != null){
            $user-> nom=$request['nom'];
            $user-> prenom=$request['prenom'];
            $user-> genre=$request['genre'];
            $user-> adresse=$request['adresse'];
            $user-> telephone=$request['telephone'];
            $user-> password=$request['password'];
            $user-> date_naissance=$request['date_naissance'];
            $user-> lieu_naissance=$request['lieu_naissance'];
            $user-> nationalite =$request['nationalite'];
            $user-> photo =$request['photo'];
            $user-> id_role =$request['id_role'];
            $user -> save();

            $tuteur -> id_user = $user -> id;
            $tuteur -> save();

            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function delete($id) {
        $tuteur = Tuteur::find($id);
        if($tuteur != null){
            $tuteur -> delete();
            return response()->json([
                'statut' => 200,
                'message' => 'L\'enregistrement a été supprimé avec succés'
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été supprimé'
            ],500);
        }
    }

    public function show($id) {
        $tuteur = Tuteur::find($id);
        if($tuteur != null){
            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'tuteur' => 'Cet enregistrement n\'existe pas'
            ],500);
        }
    }
}
