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
        'quantite',
        'date_entree',
        'id_statut',
        'id_departement',
    ];

    // Relation avec le modèle Statut
    public function statut()
    {
        return $this->belongsTo(Statut::class, 'id_statut');
    }

    // Relation avec le modèle Departement
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }
}