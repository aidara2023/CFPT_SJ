<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emploi_du_temps extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_cour',
        'id_annee_academique',
        'date_debut',       
        'date_fin',
        'heure_debut',
        'heure_fin',
        'id_salle',
       
    ];
    public function cour() {
        return $this -> belongsTo(Cour::class, 'id_cour');
    }
    public function salle() {
        return $this -> belongsTo(Salle::class, 'id_salle');
    }
    public function annee_academique() {
        return $this -> belongsTo(Annee_academique::class, 'id_annee_academique');
    }
}
