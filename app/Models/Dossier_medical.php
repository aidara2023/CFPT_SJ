<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_medical extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_user',
    ];
}
