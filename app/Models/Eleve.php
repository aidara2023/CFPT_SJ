<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;
    protected $fillable =[
        'contact_urgence1',
        'contact_urgence2',
        'id_tuteur',
        'id_user',
        'id'

    ];
    
    public function user() {
    return $this->belongsTo(User::class,'id_user');   
    }
    public function assister() {
        return $this -> hasMany(assister::class);
    }
    public function ressource_pedagogique() {
        return $this -> hasMany(ressource_pedagogique::class);
    }
    public function notes() {
        return $this -> hasMany(note::class);
    }

    public function tuteur(){
        return $this->belongsTo(Tuteur::class,'id_tuteur');
    }
    public function financer_bource(){
        return $this->belongsTo(financer_bourse::class,'id_financer_bourse');
    }
    public function inscriptions() {
        return $this -> hasMany(Inscription::class);
    }
    public function cours() {
        return $this -> hasMany(Cour::class);
    }
    public function paiements() {
        return $this -> hasMany(Paiement::class);
    }

    
}
