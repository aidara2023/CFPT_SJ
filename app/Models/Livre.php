<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'titre_livre',
        'id_categorie',
        'id_auteur',
        'id_edition',
    ];

    public function exemplaire() {
        return $this -> hasMany(Exemplaire::class, 'id_exemplaire');
    }


    public function edition() {
        return $this -> belongsTo(Edition::class, 'id_edition');
    }

    public function auteur() {
        return $this -> belongsTo(Auteur::class, 'id_auteur');
    }

    public function categorie() {
        return $this -> belongsTo(Categorie::class, 'id_categorie');
    }
}
