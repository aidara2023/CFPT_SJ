<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archive extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'titre',
        'type',
        'statut',
        'date_destruction',
        'contenu',
        'id_departement',
        'id_service'
    ];
}
