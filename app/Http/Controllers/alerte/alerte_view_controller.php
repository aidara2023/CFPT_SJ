<?php

namespace App\Http\Controllers\alerte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class alerte_view_controller extends Controller
{
    public function create(){
        return view('alerte.create');
    }
}
