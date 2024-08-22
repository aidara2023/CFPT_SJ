<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_demande', // 'materiel', 'consommable', 'both'
        'quantite_materiel',
        'quantite_consommable',
        'id_user',
        'description_materiel',  // Saisie libre pour le matériel
        'description_consommable' // Saisie libre pour le consommable
    ];

    // Relation avec la table User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
