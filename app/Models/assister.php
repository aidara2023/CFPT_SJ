<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assister extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'presence',
        'id_cour',
        'id_eleve'
    ];
}
