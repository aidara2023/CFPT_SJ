<?php

namespace App\Http\Controllers\matiere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class matiere_view_controller extends Controller
{
    public function create(){
        return view('matiere.create');
    }
}
