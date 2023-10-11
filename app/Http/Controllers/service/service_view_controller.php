<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class service_view_controller extends Controller
{
    public function create(){
        return view('service.createService');
    }
}
