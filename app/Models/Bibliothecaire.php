<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliothecaire extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'id_service',
        'id_user'
    ];

    public function emprunter_livre() {
        return $this -> hasMany(Emprunter_livre::class, 'id_emprunter_livre');
    }

    public function service() {
        return $this -> belongsTo(Service::class, 'id_service');
    }

    public function user() {
        return $this -> belongsTo(User::class, 'id_user');
    }

}
