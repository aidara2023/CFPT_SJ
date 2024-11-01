<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'nom_auteur'
    ];

    public function livre() {
        return $this -> hasMany(Livre::class, 'id_auteur');
    }
}
