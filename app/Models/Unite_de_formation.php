<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite_de_formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_unite_formation',
        'id_user',
        'id_departement'
    ];

    public function departement (){
        return $this->belongsTo(Departement::class, 'id_departement');

    }

    public function classes (){
        return $this->hasMany(Classe::class,'id');
    }

    public function materiels (){
        return $this->hasMany(Materiel::class,'id');

    }
    public function formateur (){
        return $this->hasMany(Formateur::class,'id_unite_de_formation');

    }

    public function user (){
        return $this->belongsTo(User::class,'id_user');

    }

    public function ressource_pedagogique (){
        return $this->hasMany(Ressource_pedagogique::class,'id');

    }
}
