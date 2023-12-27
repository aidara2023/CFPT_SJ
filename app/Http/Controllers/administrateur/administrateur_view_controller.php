<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class administrateur_view_controller extends Controller
{
    public function index(){
        return view('administrateur.index');
    }

    public function create_admin(){

        $matricule= User::generateur_matricule();
        $user = User::create([
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'genre' => 'masculin',
            'adresse' => 'Medina',
            'telephone' => '778793127',
            'email' => 'admin@cfpt.edu.sn',
            'password' => bcrypt('admincfpt'),
            'id_role' => 3,
            'matricule' => $matricule,
        ]);

        return response()->json(['message' => 'Admin user created successfully', 'user' => $user], 201);

    }
}
