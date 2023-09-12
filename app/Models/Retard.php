<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retard extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'date',
        'heure',
        'id_eleve',
        'id_cour'
    ];
}
