<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable= [
        'designation',
        'nombre_jour',
        'montant_jour',
        'date_location',
        'id_partenaire',
        'id_salle'
    ];

    public function partenaire() {
        return $this -> belongsTo(Partenaire::class, 'id_partenaire');
    }

    public function salle() {
        return $this -> belongsTo(Salle::class, 'id_salle');
    }
}
