<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_service',
        'id_user'   ,
        'id_direction' ,
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

      

      public function formateurs(){
        return $this->hasMany(Formateur::class);
      }

      public function direction(){
        return $this->belongsTo(Direction::class, 'id_direction');
      }

      public function personnel_admin_appui(){
        return $this->hasMany(Personnel_admin_appui::class);
    }

}
