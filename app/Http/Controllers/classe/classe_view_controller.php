<?php

namespace App\Http\Controllers\classe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class classe_view_controller extends Controller
{
    public function create(){
        return view('classe.create');
    }
}
