<?php

namespace App\Http\Controllers\comptable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class comptable_controller extends Controller
{
   public function index(){
    return view("comptable.index");
   }
}
