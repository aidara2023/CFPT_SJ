<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class financer_bourse extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_organisme',
        'id_eleve',
        'id_classe',
       'id_annee_academique',
        'Date',
        'Montant'
        

    ];
}
