<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_cours',
        'intitule',
        'heure_debut',
        'heure_fin',
        'id_classe',
        'id_formateur',
        'id_matiere',
        'id_salle',
        'id_semestre'
}
