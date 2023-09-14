<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;
    protected $fillable =[
        'intitule'
    ];

    public function note(){
        return $this->belongsToMany(note::class);
    }

    public function Cour(){
        return $this->belongsTo(Cour::class);
    }
}
