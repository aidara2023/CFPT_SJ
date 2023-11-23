<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concerner extends Model
{
    use HasFactory;
    protected $fillable=[
        'statut',
        'id_mois',
        'id_annee_academique',
        'id_paiement',
    ];

    public function paiement(){
        return $this->belongsToMany(Paiement::class,'id_paiement');
    }

    public function annee_academique(){
        return $this->belongsToMany(Annee_academique::class,'id_annee_academique');
    }

    public function mois(){
        return $this->belongsToMany(Mois::class,'id_mois');
    }

    public function concerner() {
        return $this->hasMany(Concerner::class); 
    }

}
