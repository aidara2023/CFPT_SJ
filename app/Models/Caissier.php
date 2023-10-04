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
        'id_user',
        'id_role'
    ];

    public function paiements() {
        return $this->hasMany(Paiement::class); 
    }

    public function service() {
        return $this->belongsTo(Service::class, 'id_service');
    }

    
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }


}
