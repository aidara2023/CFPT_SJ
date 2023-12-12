<?php

namespace App\Http\Controllers\caissier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class caissier_view_controller extends Controller
{
    public function create(){
        return view('caissier.create');
    }

    public function accueil(){
        return view('caissier.index');
    }
     
}
