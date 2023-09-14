<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_consultation',
        'id_user',
        'id_infirmier',
        'id_dossier_medical'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function infirmier() {
        return $this->belongsTo(Infirmier::class, 'id_infirmier');
    }

    
    public function dossier_medical() {
        return $this->belongsTo(Dossier_medical::class, 'id_dossier_medical');
    }
    
}
