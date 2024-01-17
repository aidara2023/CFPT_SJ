<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class user_view_controller extends Controller
{
    public function create(){
        return view('utilisateur.create');
    }

    public function index(){
        return view('utilisateur.index');
    }

    public function profil(){
        return view('utilisateur.profil');
    }
}
