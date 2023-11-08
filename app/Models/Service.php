<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_service',
        'id_user'   
    ];

    public function user(){
        return $this->hasOne(User::class,'id','id_user');
    }

    public function blibliothecaires(){
        return $this->hasMany(Bibliothecaire::class);
      }

      public function caissiers(){
        return $this->hasMany(Caissier::class);
      }

      public function infirmiers(){
        return $this->hasMany(Infirmier::class);
      }

      public function direction(){
        return $this->hasOne(Direction::class);
      }

      public function formateurs(){
        return $this->hasMany(Formateur::class);
      }
}
