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
        'checking_status',
        'observations',
        'urgence',
        'id_commande', // Ajout de la relation avec Commande
    ];

    const URGENCE_BASSE = 'basse';
    const URGENCE_MOYENNE = 'moyenne';
    const URGENCE_HAUTE = 'haute';

    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_VALIDE = 'validé';
    const STATUT_PARTIELLEMENT_VALIDE = 'partiellement_validé';
    const STATUT_EN_COURS = 'en_cours';
    const STATUT_RECU = 'reçu';
    const STATUT_REJETE = 'rejeté';

    // Constantes pour checking_status
    const CHECKING_NON_VERIFIE = 'non_verifié';
    const CHECKING_DISPONIBLE = 'disponible';
    const CHECKING_PARTIELLEMENT_DISPONIBLE = 'partiellement_disponible';
    const CHECKING_NON_DISPONIBLE = 'non_disponible';

    public static function getUrgences()
    {
        return [
            self::URGENCE_BASSE,
            self::URGENCE_MOYENNE,
            self::URGENCE_HAUTE,
        ];
    }

    public static function getStatuts()
    {
        return [
            self::STATUT_EN_ATTENTE,
            self::STATUT_VALIDE,
            self::STATUT_PARTIELLEMENT_VALIDE,
            self::STATUT_EN_COURS,
            self::STATUT_RECU,
            self::STATUT_REJETE,
        ];
    }

    public static function getCheckingStatuses()
    {
        return [
            self::CHECKING_NON_VERIFIE,
            self::CHECKING_DISPONIBLE,
            self::CHECKING_PARTIELLEMENT_DISPONIBLE,
            self::CHECKING_NON_DISPONIBLE,
        ];
    }

    public function demandeMateriels()
    {
        return $this->hasMany(DemandeMateriel::class, 'id_demande');
    }

    public function demandeConsommables()
    {
        return $this->hasMany(DemandeConsommable::class, 'id_demande');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }
}