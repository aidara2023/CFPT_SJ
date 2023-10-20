<?php

namespace App\Http\Controllers\mois;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class mois_view_controller extends Controller
{
    public function create(){
        return view('mois.create');
    }
}
