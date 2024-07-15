<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cahier_de_texte extends Model
{
    use HasFactory;
    protected $fillable= [
        'intitule',
        'contenu',
        'id_cour'
       
    ];

    public function cour() {
        return $this->belongsTo(Cour::class,'id_cour');
    }

}
