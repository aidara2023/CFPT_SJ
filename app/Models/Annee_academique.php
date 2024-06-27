<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annee_academique extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'intitule'
    ];
    public function inscription() {
        return $this->hasMany(Inscription::class); 
    }
    public function paiements() {
        return $this->hasMany(Paiement::class); 
    }
    public function note() {
        return $this->hasMany(Note::class); 
    }
    public function mois() {
        return $this->hasMany(Mois::class); 
    }

    public function concerner() {
        return $this->hasMany(Concerner::class); 
    }
    public function Emploi_du_temps() {
        return $this->hasMany(emploi_du_temps::class); 
    }
}

