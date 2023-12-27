<?php

namespace App\Http\Controllers\emprunter_livre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class emprunter_livre_view_controller extends Controller
{
    public function create(){
        return view('emprunter_livre.create');
    }
    public function accueil(){
        return view('emprunter_livre.accueil');
    }
}
