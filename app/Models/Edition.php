<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom_edition',
        'id_editeur',
        'annee_edition'
    ];

    public function livre() {
        return $this -> hasMany(Livre::class, 'id_livre');
    }

    public function editeur() {
        return $this -> belongsTo(Editeur::class, 'id_editeur');
    }


}
