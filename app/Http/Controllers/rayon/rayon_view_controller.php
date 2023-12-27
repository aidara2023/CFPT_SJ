<?php

namespace App\Http\Controllers\rayon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rayon_view_controller extends Controller
{
    public function create(){
        return view('rayon.create');
    }
    public function accueil(){
        return view('rayon.accueil');
    }
}
