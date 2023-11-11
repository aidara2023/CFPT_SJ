<?php

namespace App\Http\Controllers\salle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class salle_view_controller extends Controller
{
    public function create(){
        return view('salle.create');
    }
    public function accueil(){
        return view('salle.accueil');
    }
}
