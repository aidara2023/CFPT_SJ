<?php

namespace App\Http\Controllers\type_evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class type_evaluation_view_controller extends Controller
{
    public function create(){
        return view('type_evaluation.create');
    }
}
