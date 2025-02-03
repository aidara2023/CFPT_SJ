<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeMateriel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_demande',
        'materiel_id',
        'libelle',
        'quantite',
        'description',
        'a_commander',
        'quantite_disponible',
        'quantite_a_commander'
    ];

    protected $casts = [
        'a_commander' => 'boolean',
        'quantite' => 'integer'
    ];

    protected $appends = ['besoin_commande'];

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }

    public function stockMateriel()
    {
        return $this->belongsTo(StockMateriel::class, 'materiel_id');
    }

    public function getBesoinCommandeAttribute()
    {
        return $this->quantite > ($this->quantite_disponible ?? 0);
    }
}