<?php

namespace App\Http\Controllers\batiment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class batiment_view_controller extends Controller
{
    
    public function create(){
        return view('batiment.create');
    }

    public function index(){
        return view('batiment.index');
    }
}
