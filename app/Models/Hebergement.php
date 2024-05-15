<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hebergement extends Model
{
    use HasFactory;
    protected $fillable= [
        'id_eleve',
        'id_chambre',
        'quotient',
        'id_annee',
    ];

    public function eleve() {
        return $this->belongsTo(Eleve::class,'id_eleve');
    }
    public function chambre() {
        return $this->belongsTo(Chambre::class,'id_chambre');
    }
    public function annee() {
        return $this->belongsTo(Annee_academique::class,'id_annee');
    }
}
