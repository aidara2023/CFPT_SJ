<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunter_livre extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_user',
        'id_bibliothecaire',
        'id_exemplaire',
        'Date_emprunter',
        'date_retour'
        

    ];
}
