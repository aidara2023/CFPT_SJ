<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consommable extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'marque',
        'id_commande',
        'quantite',
        'date_entree',
        'id_etat',
        'id_departement',
        'source'
    ];

    // Relation avec le modèle Statut
    public function etat()
    {
        return $this->belongsTo(Etat::class, 'id_etat');
    }

    // Relation avec le modèle Departement
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }
}
