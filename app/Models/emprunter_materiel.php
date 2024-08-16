<?php

namespace App\Models;

use App\Models\Emprunter_materiel as ModelsEmprunter_materiel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunter_materiel extends Model
{
    use HasFactory;
    protected $fillable =[
        'quantite',
        'date_retour_prevue',
        'date_retour_effective',
        'etat',
        'date_emprunt',
        'id_materiel',
        'id_user',
        
    ];

    public function materiels (){
        return $this->belongsToMany(Materiel::class,'id_materiel');
        
    }

   

    public function users (){
        return $this->belongsToMany(User::class,'id_user');
        
    }

}
