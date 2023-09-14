<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caissier extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'id_service',
        'id_user'

    ];

    public function paiements() {
        return $this->hasMany(Paiement::class); 
    }

    public function service() {
        return $this->hasOne(Service::class);
    }

    
    public function user() {
        return $this->hasOne(User::class);
    }


}
