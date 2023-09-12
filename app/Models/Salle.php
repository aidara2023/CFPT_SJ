<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'nombre_place',
        'id_batiment'
    ];
    
}
