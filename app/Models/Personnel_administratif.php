<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel_administratif extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
       
    ];

    public function roles() {
        return $this->hasMany(Role::class);
      }

    
}
