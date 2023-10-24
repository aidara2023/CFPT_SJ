<?php

namespace App\Http\Controllers\direction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class direction_view_controller extends Controller
{
    public function create(){
        return view('direction.create');
    }

    public function accueil(){
        return view('direction.accueil');
    }
}
