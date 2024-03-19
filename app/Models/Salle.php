<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'nombre_place',
        'id_batiment'
    ];

    public function cours (){
        return $this->hasMany(Cour::class,'id');
        
    }

    public function materiels (){
        return $this->hasMany(Materiel::class,'id');
        
    }
    public function reservation() {
        return $this -> hasMany(Reservation::class);
    }

    public function batiment (){
        return $this->belongsTo(Batiment::class,'id_batiment');
        
    }

    public function locations() {
        return $this -> hasMany(Location::class, 'id_partenaire', 'id');
    }
    public function factures() {
        return $this -> hasMany(Facture::class, 'id_facture', 'id');
    }
    
}
