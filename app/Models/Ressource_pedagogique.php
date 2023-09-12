<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ressource_pedagogique extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'libelle',
        'contenu',
        'id_formateur',
        'id_eleve',
        'id_cour',
        'id_unite_de_formation'
    ];
}
