<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMateriel extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'marque',
        'quantite_disponible',
        'id_type_materiel',
    ];

    public function typeMateriel()
    {
        return $this->belongsTo(Type_materiel::class, 'id_type_materiel');
    }

    public function demandes()
    {
        return $this->belongsToMany(Demande::class, 'demande_stock_materiel')
            ->withPivot('quantite_demandee', 'quantite_disponible')
            ->withTimestamps();
    }
}