<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    protected $fillable= [
        'intitule',
        'id_batiment',
    ];

    public function hebergements() {
        return $this->hasMany(Hebergement::class,'id_chambre', 'id');
    }
    public function batiment() {
        return $this->belongsTo(Batiment::class, 'id_batiment');   
    }
}
