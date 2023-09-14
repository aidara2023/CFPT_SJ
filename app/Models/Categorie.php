<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable =[

        'intitule'

    ];

    public function livre() {
        return $this -> hasMany(Livre::class, 'id_livre');
    }
}
