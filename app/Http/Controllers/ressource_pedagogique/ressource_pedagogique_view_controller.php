<?php

namespace App\Http\Controllers\ressource_pedagogique;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ressource_pedagogique_view_controller extends Controller
{
    public function create(){
        return view('ressource_pedagogique.create');
    }
}
