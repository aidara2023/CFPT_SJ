<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'id_user',
        'id_materiel',
        'id_consommable'
    ];

    // Relation avec la table User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relation avec la table Materiel
    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel');
    }

    // Relation avec la table Consommable
    public function consommable()
    {
        return $this->belongsTo(Consommable::class, 'id_consommable');
    }
}

