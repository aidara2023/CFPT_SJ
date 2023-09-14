<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplaire extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Intitule',
        'id_livre',
        'id_rayon'


    ];

    public function livre() {
        return $this -> belongsTo(Livre::class, 'id_livre');
    }

    public function emprunter_livre() {
        return $this -> hasMany(Emprunter_livre::class, 'id_emprunter_livre');
    }

    public function rayon() {
        return $this -> belongsTo(Rayon::class, 'id_rayon');
    }


}
