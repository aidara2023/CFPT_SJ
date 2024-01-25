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
    'mode_paiement',
    'reference',
    'paiement_type',
  ]; 

 
    public function caissier() {
      return $this->belongsTo(Caissier::class,'id_caissier');
    }

  

    public function eleve() {
      return $this->belongsTo(Eleve::class,'id_eleve');
    }

    public function concerner() {
      return $this -> hasMany(Concerner::class, 'id_paiement');
  }


}
