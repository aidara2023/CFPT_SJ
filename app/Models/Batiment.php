<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class batiment extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'intitule'
    ];
}
