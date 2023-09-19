<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class login_view_controller extends Controller
{
    public function index (){
        return view('auth.login');
    }
}
