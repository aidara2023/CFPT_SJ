<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concerner extends Model
{
    use HasFactory;
    protected $fillable=[
        'statut',
        'id_mois',
        'id_annee_academique',
        'id_paiement',
    ];
}
