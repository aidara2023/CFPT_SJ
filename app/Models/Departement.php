<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom_departement',
        'id_direction',
        'id_user',

    ];
    public function direction (){
        return $this->belongsTo(Direction::class,'id_direction');
        
    }
    public function user (){
        return $this->belongsTo(User::class,'id_user');
        
    }

    public function unite_de_formations (){
        return $this->hasMany(Unite_de_formation::class,'id');
        
    }
}
