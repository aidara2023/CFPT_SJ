<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editeur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_editeur'
    ];


    public function edition() {
        return $this -> hasMany(Edition::class, 'id_edition');
    }
}
