<?php

namespace App\Http\Controllers\formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class formateur_view_controller extends Controller
{
    public function accueil(){
        return view('formateur.accueil');
    }

    public function liste_note(){
        return view('formateur.liste_note');
    }
    public function profil(){
        return view('formateur.profil');
    }
    public function cours(){
        return view('formateur.cours');
    }
}
