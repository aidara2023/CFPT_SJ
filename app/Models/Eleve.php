<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eleve extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'contact_urgence1',
        'contact_urgence2',
        'id_tuteur'

    ];
}
