<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    // Spécifiez les champs qui peuvent être remplis
    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'adresse',
        'secteur_activite_id',
        'produits_services',
        'nom_contact',
        'telephone_contact',
        'statut'
    ];
    public function secteurActivite()
    {
        return $this->belongsTo(SecteurActivite::class, 'secteur_activite_id');
    }
}