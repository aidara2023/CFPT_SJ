<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date_emprunter extends Model
{
    use HasFactory;
    protected $fillable =[

        'intitule'

    ];

    public function emprunter_materiels (){
        return $this->hasMany(Emprunter_materiel::class,'id');
        
    }
}
