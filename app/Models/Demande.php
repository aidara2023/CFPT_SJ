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
        'urgence',
        'observations',
        'id_commande', // Ajout de la relation avec Commande
    ];

    const URGENCE_BASSE = 'basse';
    const URGENCE_MOYENNE = 'moyenne';
    const URGENCE_HAUTE = 'haute';

    public static function getUrgences()
    {
        return [
            self::URGENCE_BASSE,
            self::URGENCE_MOYENNE,
            self::URGENCE_HAUTE,
        ];
    }

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

    // Relation avec Commande
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande'); // Lien vers la commande associée
    }
}