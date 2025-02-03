<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    // Constantes pour les statuts
    const STATUTS = [
        'envoyé',
        'en_attente',
        'livré',
        'non_livré'
    ];

    protected $fillable = [
        'reference_commande',
        'statut',
        'id_demande',
        'date_commande',
    ];

    protected $casts = [
        'id_demande' => 'array'
    ];

    protected $appends = ['nombre_demandes'];

    public function getNombreDemandesAttribute()
    {
        return is_array($this->id_demande) ? count($this->id_demande) : 0;
    }

    // Relation avec les demandes
    public function demandes()
    {
        return $this->hasManyThrough(
            Demande::class,
            'id_demande',
            null,
            'id',
            null,
            null
        )->whereIn('id', is_array($this->id_demande) ? $this->id_demande : []);
    }

    // Accesseur pour id_demande (decode JSON)
    public function getIdDemandeAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutateur pour id_demande (encode JSON)
    public function setIdDemandeAttribute($value)
    {
        $this->attributes['id_demande'] = is_array($value) ? json_encode($value) : $value;
    }

    public static function getStatuts()
    {
        return self::STATUTS;
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($commande) {
            if ($commande->isDirty('statut')) {
                if ($commande->statut === 'livré') {
                    // Mettre à jour le statut de toutes les demandes associées
                    $demandes = Demande::whereIn('id', json_decode($commande->id_demande, true))->get();
                    foreach ($demandes as $demande) {
                        $demande->update(['statut' => Demande::STATUT_RECU]);
                    }
                }
            }
        });
    }
}