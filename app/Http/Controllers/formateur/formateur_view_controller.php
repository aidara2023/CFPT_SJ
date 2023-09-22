<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class formateur_view_controller extends Controller
{
    public function accueil(){
        return view('formateur.accueil');
    }
}
