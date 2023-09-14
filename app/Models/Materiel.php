<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'Nom',
        'date_entree',
        'date_sortie',
        'Etat',
        'Quantité',
        'id_service',
        'id_salle',
        'id_type_materiel',
        'id_statut',
        'id_unite_de_formation'
        

    ];

    public function salle (){
        return $this->belongsTo(Salle::class,'id_salle');
        
    }

    public function statut (){
        return $this->belongsTo(Statut::class,'id_statut');
        
    }

    public function unite_de_formation (){
        return $this->belongsTo(Unite_de_formation::class,'id_unite_de_formation');
        
    }

    public function type_materiel (){
        return $this->belongsTo(Type_materiel::class,'id_type_materiel');
        
    }

    public function service (){
        return $this->belongsTo(Service::class,'id_service');
        
    }

    public function emprunter_materiel (){
        return $this->hasMany(Emprunter_materiel::class,'id');
        
    }
}
