<?php

namespace App\Models;

use App\Models\Emprunter_materiel as ModelsEmprunter_materiel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunter_materiel extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_materiel',
        'id_user',
       'id_date_emprunt',
      'date_retour_prevue',
      'date_retour_effective',
      'statut'
        

    ];

    public function materiels (){
        return $this->belongsToMany(Materiel::class,'id_materiel');
        
    }

    public function date_emprunters (){
        return $this->belongsToMany(Date_emprunter::class,'id_date_emprunt');
        
    }

    public function users (){
        return $this->belongsToMany(User::class,'id_user');
        
    }

}
