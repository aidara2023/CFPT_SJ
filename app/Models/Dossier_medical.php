<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_medical extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_user',
        'id_infirmier',
        'antecedents',
        'diagnostics',
        'traitements',
        'resultats_tests'
    ];

    public function consultation() {
        return $this->hasMany(Consultation::class); 
    }

    public function user() {
        return $this->hasOne(User::class);
    }

}
