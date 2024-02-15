<?php

namespace App\Http\Controllers\eleve;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class eleve_view_controller extends Controller
{
    public function inscription(){
        return view('eleve.inscription');
    }
    public function liste(){
        return view('eleve.liste_inscription');
    }
}
