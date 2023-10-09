<?php

namespace App\Http\Controllers\assister;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class assister_view_controller extends Controller
{
    public function create(){
        return view('assister.create');
    }
}
