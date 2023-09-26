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
        'date_cour',
        'id_semestre'
    ];

    public function Matiere(){
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }

    public function Semestre(){
        return $this->belongsTo(Semestrre::class, 'id_semestre');
    }

    public function Classe(){
        return $this->belongsTo(Classe::class, 'id_class');
    }

    public function assister(){
        return $this->hasMany(assiter::class);
    }

    public function Salle(){
        return $this->belongsTo(Salle::class, 'id_salle');
    }

    public function Formateur(){
        return $this->belongsTo(Formateur::class, 'id_formateur');
    }



}
