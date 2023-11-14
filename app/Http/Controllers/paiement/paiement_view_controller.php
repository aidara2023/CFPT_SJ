<?php

namespace App\Http\Controllers\paiement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class paiement_view_controller extends Controller
{
    public function create(){
        return view('paiement.create');
    }

    public function reçu(){
        return view('reçu.index');
    }
}
