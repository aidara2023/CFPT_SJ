<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infirmier extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_dossier_medical',
        'id_user'
        

    ];
}
