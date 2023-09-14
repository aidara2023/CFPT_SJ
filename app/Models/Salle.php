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

    public function batiment (){
        return $this->belongsTo(Batiment::class,'id_batiment');
        
    }
    
}
