<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'categorie_personnel',
       
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function permissions() {
        return $this->hasMany(Permission::class, 'id_role','id');
    }

    
    
}
