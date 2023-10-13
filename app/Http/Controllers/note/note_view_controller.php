<?php

namespace App\Http\Controllers\note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class note_view_controller extends Controller
{
    public function create(){
        return view('note.create');
    }
}
