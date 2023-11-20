<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'id_personnel_administratif',
        'id_personnel_appui'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function admin(){
        return $this->belongsTo(Personnel_administratif::class, 'id_personnel_administratif',);
    }

    public function appui(){
        return $this->belongsTo(Personnel_appui::class, 'id_personnel_appui');
    }
    
}
