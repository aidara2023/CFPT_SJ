<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule'
    ];

    public function classe (){
        return $this->hasMany(Classe::class,'id');
    
    }
}
