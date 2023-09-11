<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_eleve',
        'id_formateur',
        'id_type_evaluation',
        'id_annee_academique',
        'id_matiere',
        'note_obtenue',
        'date_enregistrer',
        'appreciation',
        'observation'
        ];


}
