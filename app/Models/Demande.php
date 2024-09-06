<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_demande',
        'id_user',
        'statut',
    ];

    // Relation avec la table User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relation avec la table DemandeMateriel
    public function materiels()
    {
        return $this->hasMany(DemandeMateriel::class, 'id_demande');
    }

    // Relation avec la table DemandeConsommable
    public function consommables()
    {
        return $this->hasMany(DemandeConsommable::class, 'id_demande');
    }
}