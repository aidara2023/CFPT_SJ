<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class editeur extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom_editeur'
    ];
}
