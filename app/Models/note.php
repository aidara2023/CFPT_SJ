<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_eleve',
        'id_formateur',
        'id_type_evaluation',
        'id_annee_academique',
        'id_matiere',
        'note_obtenue',
        'date_enregistrer',
        'appreciation',
        'observation'
        ];

        public function Type_evaluation(){
            return $this->belongsToMany(Type_evaluation::class, 'id_type_evaluation');
        }

        public function Matiere(){
            return $this->belongsToMany(Matiere::class, 'id_matiere');
        }

        public function Semestre(){
            return $this->belongsToMany(Semestre::class);
        }

        public function Annee_academique(){
            return $this->belongsToMany(Annee_academique::class,'id_annee_academique');
        }

        public function Eleve(){
            return $this->belongsToMany(Eleve::class,'id_eleve');
        }

        public function Formateur(){
            return $this->belongsToMany(Formateur::class,'id_formateur');
        }


}
