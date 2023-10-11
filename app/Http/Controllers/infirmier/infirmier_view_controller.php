<?php

namespace App\Http\Controllers\infirmier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class infirmier_view_controller extends Controller
{
   public function create(){
        return view('infirmier.create');
   }
}
