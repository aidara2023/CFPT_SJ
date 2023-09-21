<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retard extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'date',
        'heure',
        'id_eleve',
        'id_cour'
    ];
    public function eleves(){
        return $this->belongsToMany(Eleve::class,'id_eleve');
    }
    public function cours(){
        return $this->belongsToMany(Cour::class,'id_cour');
    }
    
}
