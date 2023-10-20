<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_classe',
        'nom_classe',
        'type_classe',
        'niveau',
        'id_type_formation',
        'id_unite_de_formation'
    ];
    public function inscription() {
        return $this -> hasMany(Inscription::class);
    }
    public function cour() {
        return $this -> hasMany(Cour::class);
    }
    public function unite_de_formation() {
        return $this -> belongsTo(Unite_de_formation::class,'id_unite_de_formation');
    }
    public function type_formation() {
        return $this -> belongsTo(type_formation::class,'type_formation');
    }
    public function classes(){
        return $this->hasMany(Classe::class);
      }
      public function annee_academiques(){
        return $this->hasMany(Annee_academique::class);
      }
    
}
