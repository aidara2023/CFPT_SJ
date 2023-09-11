<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'date_debut',
        'date_fin',
        'description',
        'id_direction',
    ];
}
