<?php

namespace App\Http\Controllers\seminaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class seminaire_view_controller extends Controller
{
    public function create(){
        return view('seminaire.create');
    }
}
