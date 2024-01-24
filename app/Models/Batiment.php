<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'intitule'
    ];

    public function salle (){
        return $this->hasMany(Salle::class, 'id_batiment');
    }
}
