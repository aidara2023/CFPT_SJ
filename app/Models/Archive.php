<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'titre',
        'type',
        'statut',
        'date_destruction',
        'contenu',
        'id_departement',
        'id_service'
    ];
    public function departement(){
        return $this->belongsTo(Departement::class,'id_departement');
    }
    public function cour(){
        return $this->belongsTo(Cour::class,'id_cour');
    }
}
