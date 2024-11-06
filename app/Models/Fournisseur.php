<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    // Spécifiez les champs qui peuvent être remplis
    protected $fillable = [
        'nom',
        'telephone',
        'email',
    ];
}