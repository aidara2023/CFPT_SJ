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
        'id_reservation',
        'id_user',
    ];

    public function location() {
        return $this -> belongsTo(Location::class, 'id_location');
    }
    public function reservation() {
        return $this -> belongsTo(Reservation::class, 'id_reservation');
    }
    public function user() {
        return $this -> belongsTo(User::class, 'id_user');
    }
}
