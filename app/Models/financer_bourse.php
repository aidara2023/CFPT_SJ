<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financer_bourse extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_organisme',
        'id_eleve',
        'id_classe',
        'id_annee_academique',
        'date',
        'montant'
        
    ];
    public function eleves(){
        return $this->hasMany(Eleve::class);
      }
      public function classe(){
        return $this->belongsTo(Classe::class,'id_classe');
      }
      public function organisme(){
        return $this->belongsTo(Organisme::class,'id_organisme');
      }
      public function annee_academique(){
        return $this->belongsTo(Annee_academique::class,'id_annee_academique');
      }
}
