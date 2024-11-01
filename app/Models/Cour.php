<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_cours',
     /*    'heure_debut',
        'heure_fin', */
        'id_classe',
        'id_formateur',
        'id_matiere',
        'id_annee_academique',
        /* 'date_cour', */
        'id_semestre'
    ];

    public function Matiere(){
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }

    public function Semestre(){
        return $this->belongsTo(Semestre::class, 'id_semestre');
    }

    public function Classe(){
        return $this->belongsTo(Classe::class, 'id_classe');
    }

    public function assister(){
        return $this->hasMany(Assister::class);
    }
    
    public function emploi_du_temps(){
        return $this->hasMany(Emploi_du_temps::class);
    }

    public function annee(){
        return $this->belongsTo(Annee_academique::class, 'id_annee_academique');
    }

    public function Formateur(){
        return $this->belongsTo(Formateur::class, 'id_formateur');
    }



}
