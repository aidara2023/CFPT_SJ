<?php

namespace App\Http\Controllers\livre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class livre_controller extends Controller
{
    public function index() {
        $user=User::all();
        
        }
}
