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
        'id_service'
  ];

  public function user(){
    return $this->belongsTo(User::class, 'id_user');
  }

  public function service(){
    return $this->belongsTo(Service::class, 'id_service');
  }

  public function departements(){
    return $this->hasMany(Departement::class);
  }



}
