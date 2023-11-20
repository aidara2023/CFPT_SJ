<?php

namespace App\Http\Controllers\recouvrement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class recouvrement_view_controller extends Controller
{
    public function index(){
        return view('recouvrement.index');
    }
}
