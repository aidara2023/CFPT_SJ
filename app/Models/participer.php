<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participer extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_participation',
        'id_seminaire',
        'id_formateur'
    ];
    public function seminaires(){
        return $this->belongsToMany(Seminaire::class,'id_seminaire');
    }
    public function formateur(){
        return $this->belongsToMany(Formateur::class,'id_formateur');
    }
}
