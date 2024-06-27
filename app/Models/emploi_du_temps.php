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
       
    ];
    public function cour() {
        return $this -> belongsTo(Cour::class, 'id_cour');
    }
    public function annee_academique() {
        return $this -> belongsTo(Annee_academique::class, 'id_annee_academique');
    }
}
