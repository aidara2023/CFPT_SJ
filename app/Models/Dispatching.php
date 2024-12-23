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
        'id_user',
        'id_materiel',
        'id_consommable',
        'id_batiment',
        'id_commande',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel');
    }
    public function consommable()
    {
        return $this->belongsTo(Consommable::class, 'id_consommable');
    }
 
    public function batiment()
    {
        return $this->belongsTo(Batiment::class, 'id_batiment');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }
}
