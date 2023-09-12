<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_consultation',
        'id_user',
        'id_infirmier',
        'id_dossier_medical'
    ];
}
