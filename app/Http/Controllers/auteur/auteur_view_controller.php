<?php

namespace App\Http\Controllers\auteur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class auteur_view_controller extends Controller
{
    public function create(){
        return view('auteur.create');
    }
    public function accueil(){
        return view('auteur.accueil');
    }
}
