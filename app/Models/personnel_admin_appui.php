<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnel_admin_appui extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_service',
        'type_personnel'
       
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
      }
      public function service() {
        return $this->belongsTo(Service::class, 'id_service');
      }

}
