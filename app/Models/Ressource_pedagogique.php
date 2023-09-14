<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource_pedagogique extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'libelle',
        'contenu',
        'id_formateur',
        'id_eleve',
        'id_cour',
        'id_unite_de_formation'
    ];
    public function formateurs(){
        return $this->belongsToMany(formateur::class,'id_formateur');
    }
    public function cour(){
        return $this->belongsTo(Cour::class,'id_cour');
    }
    public function eleves(){
        return $this->belongsTo(Eleve::class,'id_eleve');
    }
    public function unite_de_formation(){
        return $this->belongsTo(Unite_de_formation::class,'id_unite_de_formation');
    }
}
