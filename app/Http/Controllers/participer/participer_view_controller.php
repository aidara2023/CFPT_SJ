<?php

namespace App\Http\Controllers\participer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class participer_view_controller extends Controller
{
    public function create(){
        return view('participer.create');
    }
}
