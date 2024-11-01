<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle'
    ];
    public function classe() {
        return $this -> hasMany(Classe::class);
    }
}
