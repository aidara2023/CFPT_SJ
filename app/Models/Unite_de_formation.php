<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unite_de_formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_unite_formation',
        'id_formateur',
        'id_departement'
    ];
}
