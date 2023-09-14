<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assister extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'presence',
        'id_cour',
        'id_eleve'
    ];
    public function eleves(){
        return $this->belongsToMany(Eleve::class,'id_eleve');
    }
    public function cours(){
        return $this->belongsToMany(Cour::class,'id_cour');
    }
}
