<?php

namespace App\Http\Controllers\unite_de_formation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class unite_de_formation_view_controller extends Controller
{
    public function create(){
        return view('unite_de_formation.create');
    }
}
