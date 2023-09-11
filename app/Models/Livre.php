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
         'id_edition'
        

    ];
}
