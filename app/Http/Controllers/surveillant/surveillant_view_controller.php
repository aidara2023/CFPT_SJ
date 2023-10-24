<?php

namespace App\Http\Controllers\surveillant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class surveillant_view_controller extends Controller
{
    public function index(){
        return view("surveillant.index");
    }
}
