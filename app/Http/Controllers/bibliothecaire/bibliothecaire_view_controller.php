<?php

namespace App\Http\Controllers\bibliothecaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class bibliothecaire_view_controller extends Controller
{
    public function create(){
        return view('bibliothecaire.create');
    }
    public function accueil(){
        return view('bibliothecaire.accueil');
    }
}
