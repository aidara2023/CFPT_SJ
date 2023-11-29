<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Direction extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom_direction',
        'id_user',
        
  ];

  public function user(){
    return $this->belongsTo(User::class, 'id_user');
  }

  

  public function formateurs(){
    return $this->hasMany(Formateur::class);
  }

  public function services(){
    return $this->hasMany(Service::class, 'id_direction', 'id');
  }



}
