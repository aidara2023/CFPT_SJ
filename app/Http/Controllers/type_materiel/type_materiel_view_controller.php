<?php

namespace App\Http\Controllers\type_materiel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class type_materiel_view_controller extends Controller
{
    public function create(){
        return view('type_materiel.create');
    }
    
}
