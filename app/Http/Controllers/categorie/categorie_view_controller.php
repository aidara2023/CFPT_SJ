<?php

namespace App\Http\Controllers\categorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categorie_view_controller extends Controller
{
    public function create(){
        return view('categorie.create');
    }
    public function accueil(){
        return view('categorie.accueil');
    }
}
