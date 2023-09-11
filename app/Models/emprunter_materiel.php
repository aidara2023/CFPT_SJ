<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emprunter_materiel extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_materiel',
        'id_user',
       'id_date_emprunt',
      'date_retour_prevue',
      'date_retour_effective',
      'statut'
        

    ];
}
