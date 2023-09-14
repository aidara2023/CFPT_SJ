<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user'
    ];

    public function eleves(){
        return $this->hasMany(Eleve::class,'id');
    }
}
