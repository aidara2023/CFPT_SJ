<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeMateriel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_demande',
        'libelle',
        'quantite',
        'description',
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}