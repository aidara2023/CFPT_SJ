<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_medical extends Model
{
    use HasFactory;
    protected $fillable =[

        'id_user'

    ];

    public function consultation() {
        return $this->hasMany(Consultation::class); 
    }

    public function user() {
        return $this->hasOne(User::class);
    }

}
