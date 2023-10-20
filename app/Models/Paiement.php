<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable =[
    'id_eleve',
    'id_caissier',
    'montant',
    /* 'id_annee_academique',
    'mois' */
  ];

      
    public function caissier() {
      return $this->belongsTo(Caissier::class,'id_caissier');
    }
    public function annee_academique() {
      return $this->belongsTo(Annee_academique::class,'id_annee_academique');
    }
  
    public function eleve() {
      return $this->belongsTo(Eleve::class,'id_eleve');
    }

    public function mois() {
      return $this->hasMany(mois::class);
    }
  

}
