<?php

namespace App\Http\Controllers\personnel_administratif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class personnel_administratif_view_controller extends Controller
{
    public function create(){
        return view('personnel_administratif.create');
    }

    public function index(){
        return view('personnel_administratif.index');
    }
}
