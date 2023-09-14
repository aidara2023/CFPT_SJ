<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_partenaire',
        'type',
        'description',
        'contact',
        'email',
        'adresse',
        'boite_postale',
        'date_debut',
        'date_fin',
        'id_direction',
        'id_user'
    ];

    public function user (){
        return $this->belongsTo(User::class,'id_user');
        
    }

    public function direction (){
        return $this->belongsTo(Direction::class,'id_direction');
        
    }
}
