<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_materiel extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule'
    ];

    public function materiel (){
        return $this->hasMany(Materiel::class,'id');
        
    }
}
