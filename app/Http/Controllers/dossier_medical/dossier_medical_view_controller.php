<?php

namespace App\Http\Controllers\dossier_medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class dossier_medical_view_controller extends Controller
{
    public function create(){
        return view('dossier_medical.create');
    }

}
