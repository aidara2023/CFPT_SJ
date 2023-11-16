<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reçu extends Model
{
    use HasFactory;
    protected $fillable= [
            'numero_operation',
            'date_emis',
            'date_imprime',
            'id_paiement',
            'status',
            'id_quittance',
            'montant_total',
            'montant_paye',
            'reste'
    ];
}
