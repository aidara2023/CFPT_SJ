<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'description'
    ];

    public function exemplaire() {
        return $this -> hasMany(Exemplaire::class, 'id_exemplaire');
    }
}
