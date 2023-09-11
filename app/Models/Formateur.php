<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Type',
        'Situation_matrimoniale',
        'id_specialite',
        'id_departement'
        

    ];
}
