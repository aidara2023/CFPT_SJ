<?php

namespace App\Http\Controllers\type_formation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class type_formation_view_controller extends Controller
{
    public function create(){
        return view('type_formation.create');
    }
    public function index(){
        return view('type_formation.index');
    }
}
