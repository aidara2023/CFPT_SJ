<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurActivite extends Model
{
    use HasFactory;

    // Spécifiez les champs qui peuvent être remplis
    protected $fillable = [
        'nom',
        'description',
    ];
} 