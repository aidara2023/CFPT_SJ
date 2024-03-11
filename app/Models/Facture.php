<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable= [
        'type',
        'objet',
        'montant_payer',
        'date_facture',
        'id_location',
    ];

    public function location() {
        return $this -> belongsTo(Salle::class, 'id_location');
    }
}
