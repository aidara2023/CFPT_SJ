<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classe extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_classe',
        'nom_classe',
        'Type classe',
        'Niveau',
        'id_type formation',
        'id_unite_de_formation'
    ];
    
}
