<?php

namespace App\Http\Controllers\editeur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class editeur_view_controller extends Controller
{
    public function create(){
        return view('editeur.create');
    }
    public function accueil(){
        return view('editeur.accueil');
    }
}
