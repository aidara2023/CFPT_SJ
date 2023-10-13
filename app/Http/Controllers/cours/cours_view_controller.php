<?php

namespace App\Http\Controllers\cours;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cours_view_controller extends Controller
{
    public function create(){
        return view('cour.create');
    }
}
