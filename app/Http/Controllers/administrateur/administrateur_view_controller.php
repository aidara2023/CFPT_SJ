<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class administrateur_view_controller extends Controller
{
    public function index(){
        return view('administrateur.index');
    }
}
