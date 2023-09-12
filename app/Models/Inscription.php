<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscription extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Montant',
        'date_inscription',
        'id eleve',
        'id_classe',
        'id_annee_academique'
        

    ];
}
