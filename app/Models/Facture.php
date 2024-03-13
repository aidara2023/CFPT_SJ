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
        'id_user',
    ];

    public function location() {
        return $this -> belongsTo(Location::class, 'id_location');
    }
    public function user() {
        return $this -> belongsTo(User::class, 'id_user');
    }
}
