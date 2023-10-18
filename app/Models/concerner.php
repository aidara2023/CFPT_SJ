<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class concerner extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_concerner',
        'id_paiement',
        'id_mois'
    ];

    public function paiements(){
        return $this->belongsToMany(paiement::class,'id_paiement');
    }
    public function mois(){
        return $this->belongsToMany(mois::class,'id_mois');
    }
}