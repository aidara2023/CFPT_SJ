<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exemplaire extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Intitule',
        'id_livre',
        'id_rayon'
        

    ];
}
