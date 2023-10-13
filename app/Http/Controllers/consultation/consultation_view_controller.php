<?php

namespace App\Http\Controllers\consultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class consultation_view_controller extends Controller
{
    public function create(){
        return view('consultation.create');
    }
}
