<?php

namespace App\Http\Controllers\livre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class livre_view_controller extends Controller
{
    public function create(){
        return view('livre.create');
    }
    public function accueil(){
        return view('livre.accueil');
    }
}
