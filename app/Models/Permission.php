<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable=[
        'read',
        'update',
        'create',
        'delete',
        'id_role',
        'id_fonctionnalite',
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function fonctionnalite() {
        return $this->belongsTo(Fonctionnalite::class, 'id_fonctionnalite');
    }
}
