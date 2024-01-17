<?php

namespace App\Http\Controllers\connexion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class connexion_view_controller extends Controller
{
    public function index(){
        return view("alerte.userLocked");
    }
}
