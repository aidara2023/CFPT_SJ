<?php

namespace App\Http\Controllers\personnel_appui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class personnel_appui_view_controller extends Controller
{
    
    public function create(){
        return view('personnel_appui.create');
    }

    public function index(){
        return view('personnel_appui.index');
    }
}
