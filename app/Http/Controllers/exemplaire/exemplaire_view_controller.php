<?php

namespace App\Http\Controllers\exemplaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class exemplaire_view_controller extends Controller
{
    public function create(){
        return view('exemplaire.create');
    }
    public function accueil(){
        return view('exemplaire.accueil');
    }
}
