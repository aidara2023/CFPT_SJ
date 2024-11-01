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
        'id_statut',
        'id_type_materiel',
        'id_departement'
    ];

    // Relation avec la table Statut
    public function statut()
    {
        return $this->belongsTo(Statut::class, 'id_statut');
    }

    // Relation avec la table TypeMateriel
    public function typeMateriel()
    {
        return $this->belongsTo(Type_materiel::class, 'id_type_materiel');
    }

    // Relation avec la table Departement
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }
}
