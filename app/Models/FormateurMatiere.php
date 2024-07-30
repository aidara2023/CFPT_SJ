<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormateurMatiere extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_matiere',
        'id_formateur'
       
    ];
    public function matiere() {
        return $this -> belongsTo(Matiere::class, 'id_matiere');
    }
    public function formateur() {
        return $this -> belongsTo(Formateur::class, 'id_formateur');
    }
  
}
