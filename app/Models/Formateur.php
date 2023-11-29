<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Type',
        'Situation_matrimoniale',
        'id_specialite',
        'id_unite_de_formation',
        'id_user'
    ];
    public function user() {
        return $this->belongsTo(User::class,'id_user'); 
    }
    public function specialite() {
        return $this -> belongsTo(Specialite::class,'id_specialte');
    }
    public function cour() {
        return $this -> hasMany(Cour::class);
    }
    public function notes() {
        return $this->hasMany(note::class); 
    }
    public function ressource_pedagogiques() {
        return $this->hasMany(Ressource_pedagogique::class); 
    }
    public function departement() {
        return $this->belongsTo(Departement::class,'id_departement'); 
    }
    public function unite_de_formation() {
        return $this->belongsTo(Unite_de_formation::class,'id_unite_de_formation'); 
    }

}
