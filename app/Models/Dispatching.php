<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatching extends Model
{
    use HasFactory;

    protected $table = 'dispatchings';

    protected $fillable = [
        'quantite',
        'id_departement',
        'id_salle',
        'id_materiel',
    ];

    // Relations (à définir selon les autres modèles)
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'id_salle');
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel');
    }
}
