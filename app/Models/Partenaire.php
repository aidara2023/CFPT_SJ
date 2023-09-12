<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partenaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_partenaire',
        'type',
        'description',
        'contact',
        'email',
        'adresse',
        'boite_postale',
        'date_debut',
        'date_fin',
        'id_direction',
    ];
}
