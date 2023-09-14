<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Direction extends Model
{
    use HasFactory;
    protected $fillable =[
        'intitule',
        'nom_direction',
        'id_user'
  ];

  public function user(){
    return $this->hasOne(User::class);
  }

  public function services(){
    return $this->hasMany(Service::class);
  }
  
  public function departements(){
    return $this->hasMany(Departement::class);
  }

 

}
