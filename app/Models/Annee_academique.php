<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annee_academique extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'intitule'
    ];
}
