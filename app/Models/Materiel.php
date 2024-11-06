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
        'id_demande',
        'id_departement'
    ];

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

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}