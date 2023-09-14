<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'intitule'
        ];

        public function note(){
            return $this->belongsToMany(note::class);
        }

        public function Cour(){
            return $this->belongsTo(Cour::class);
        }
}
