<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Nom',
        'date_entree',
        'date_sortie',
        'Etat',
        'Quantité',
        'id_service',
        'id_salle',
        'id_type_materiel',
        'id_statut',
        'id_unite_formation'
        

    ];
}
