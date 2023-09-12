<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direction extends Model
{
    use HasFactory;
    protected $fillable =[
        'intitule',
        'nom_direction',
        'id_user'
    ];
}
