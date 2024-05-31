<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseMatiere extends Model
{
    use HasFactory;
    protected $fillable= [
        'id_classe',
        'id_matiere',
    ];


    public function matiere() {
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }


    public function classe() {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
}
