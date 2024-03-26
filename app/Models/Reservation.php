<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_debut',
        'date_fin',
        'id_salle',
        'id_location',
        'facturer',
        'acompter',
        'solder',
    ];
    
    public function salle (){
        return $this->belongsTo(Salle::class,'id_salle', 'id');
        
    }
    public function location (){
        return $this->belongsTo(Location::class,'id_location', 'id');
        
    }
}

