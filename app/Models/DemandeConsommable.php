<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeConsommable extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_demande',
        'consommable_id',
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

    public function stockConsommable()
    {
        return $this->belongsTo(StockConsommable::class, 'consommable_id');
    }

    public function getBesoinCommandeAttribute()
    {
        return $this->quantite > ($this->quantite_disponible ?? 0);
    }
}