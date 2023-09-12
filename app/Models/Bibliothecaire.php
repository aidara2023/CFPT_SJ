<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bibliothecaire extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'id_service',
        'id_user'
    ];
}
