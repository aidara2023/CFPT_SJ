<?php

namespace App\Http\Controllers\departement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class departement_view_controller extends Controller
{
    public function create(){
        return view('departement.create');
    }
}
