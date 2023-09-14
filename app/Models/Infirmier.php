<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infirmier extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_dossier_medical',

        'id_user',
        'id_service'


    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function service() {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public function consultation() {
        return $this->hasMany(Consultation::class); 
    }

}
