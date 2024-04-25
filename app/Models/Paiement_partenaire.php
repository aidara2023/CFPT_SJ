<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement_partenaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_facture',
        'date_paiement',
        'mode_paiement',
        'montant_payer'
       
    ];
    public function facture (){
        return $this->belongsTo(Facture::class,'id_facture');
        
    }
}
