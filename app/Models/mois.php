<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mois extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'intitule',
       /*  'statut', */
       /*  'id_annee_academique' */
        ];

        public function annee_academique(){
            return $this->belongsTo(annee_academique::class);
        }
        public function paiement(){
            return $this->hasMany(paiement::class);
        }
}
