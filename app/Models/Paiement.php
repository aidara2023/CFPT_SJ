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
    'type_recouvrement',
  ]; 

 
    public function caissier() {
      return $this->belongsTo(Caissier::class,'id_caissier');
    }

  

    public function eleve() {
      return $this->belongsTo(Eleve::class,'id_eleve');
    }

    public function concerner() {
      return $this -> hasMany(concerner::class, 'id_paiement');
  }


}
