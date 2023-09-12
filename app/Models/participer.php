<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participer extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_participation',
        'id_seminaire',
        'id_formateur'
    ];
}
