<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisme extends Model
{
    use HasFactory;
     protected $fillable =[
         'id',
         'nom_organisme'
         ];
         public function financer_bource(){
            return $this->hasMany(Financer_bourse::class);
          }
}
