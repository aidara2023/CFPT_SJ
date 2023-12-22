<?php

namespace App\Http\Controllers\edition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class edition_view_controller extends Controller
{
    public function create(){
        return view('edition.create');
    }
    public function accueil(){
        return view('edition.accueil');
    }
}
