<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_entree',
        'quantite',
        'marque',
        'libelle',
        'id_etat',
        'id_type_materiel',
        'id_commande',
        'id_departement',
        'source'
    ];

    protected static function boot()
    {
        parent::boot();

        // Observer pour la mise à jour de la source quand la commande est livrée
        static::updating(function ($materiel) {
            if ($materiel->isDirty('id_commande') && $materiel->id_commande) {
                $commande = Commande::find($materiel->id_commande);
                if ($commande && $commande->statut === 'livré') {
                    $materiel->source = 'commande';
                }
            }
        });
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class, 'id_etat');
    }

    public function typeMateriel()
    {
        return $this->belongsTo(Type_materiel::class, 'id_type_materiel');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }
}