<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'titre',
        'message',
        'statut',
        'id_user'
    ];
    public function user() {
        return $this->belongsTo(User::class,'id_user'); 
    }
}
