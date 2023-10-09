<?php

namespace App\Http\Controllers\financer_bourse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class financer_bourse_view_controller extends Controller
{
    public function create(){
        return view('finance_bourse.create');
    }
}
