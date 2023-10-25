<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'montant',
        'date_inscription',
        'id_eleve',
        'id_classe',
        'id_annee_academique',
        'dossier',



    ];

    public function eleve() {
        return $this->belongsTo(Eleve::class,'id_eleve');
      }

      public function classe() {
        return $this->belongsTo(Classe::class,'id_classe');
      }

      public function annee_academique() {
        return $this->belongsTo(Annee_academique::class,'id_annee_academique');
      }

}
