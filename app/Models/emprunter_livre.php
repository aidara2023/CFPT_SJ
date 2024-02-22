<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunter_livre extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_user',
        'id_bibliothecaire',
        'id_exemplaire',
        'Date_emprunter',
        'date_retour',
        'date_retour_effective'
    ];

    public function exemplaire() {
        return $this -> belongsTo(Exemplaire::class, 'id_exemplaire');
    }

    public function bibliothecaire() {
        return $this -> belongsTo(Bibliothecaire::class, 'id_bibliothecaire');
    }

    public function user() {
        return $this -> belongsTo(User::class, 'id_user');
    }




}
