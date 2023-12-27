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

    public function mois()
    {
        return $this->belongsTo(Mois::class, 'id_mois');
    }

    // Définir la relation avec la table annee_academique
    public function annee_academique()
    {
        return $this->belongsTo(Annee_academique::class, 'id_annee_academique');
    }

    // Définir la relation avec la table paiement
    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'id_paiement');
    }

}
