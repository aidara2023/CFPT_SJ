<?php

namespace App\Http\Controllers\organisme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class organisme_view_controller extends Controller
{
    public function create(){
        return view('organisme.create');
    }
}
