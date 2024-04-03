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
        'id_salle',
        'id_user',
        'reserver',
        'objet'
    ];

    public function partenaire() {
        return $this -> belongsTo(Partenaire::class, 'id_partenaire');
    }

    public function salle() {
        return $this -> belongsTo(Salle::class, 'id_salle');
    }

    public function user() {
        return $this -> belongsTo(User::class, 'id_user');
    }
    public function reservation() {
        return $this -> hasMany(Reservation::class,'id_location', 'id');
    }

    public function factures() {
        return $this -> hasMany(Facture::class, 'id_location');
    }
}
