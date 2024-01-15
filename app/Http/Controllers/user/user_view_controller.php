<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class user_view_controller extends Controller
{
    public function create(){
        return view('utilisateur.create');
    }

    public function index(){
        return view('utilisateur.index');
    }

    
}
