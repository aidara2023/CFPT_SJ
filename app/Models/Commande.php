<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_commande',
        'id_demande',
        'date_commande',
        'statut',
    ];

    protected $casts = [
        'id_demande' => 'array'
    ];

    protected $appends = ['nombre_demandes'];

    public function getNombreDemandesAttribute()
    {
        return count(json_decode($this->id_demande ?? '[]', true));
    }

    // Modifiez la relation demandes comme ceci
    public function demandes()
    {
        return $this->hasManyThrough(
            Demande::class,
            'id_demande',
            null,
            'id',
            null,
            null
        )->whereIn('id', json_decode($this->id_demande ?? '[]', true));
    }
}