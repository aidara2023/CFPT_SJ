<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Demande;

class StockConsommable extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'marque',
        'quantite_disponible',
    ];

    public function demandes()
    {
        return $this->belongsToMany(Demande::class, 'demande_stock_consommable')
            ->withPivot('quantite_demandee', 'quantite_disponible')
            ->withTimestamps();
    }
}