<?php

namespace App\Http\Controllers\recouvrement;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Paiement;
use Illuminate\Http\Request;

class recouvrement_controller extends Controller
{
    public function filtre(){
    $inscriptions=Eleve:: with('inscription.classe.type_formation', 'eleve.user')->get(); 

    $inscription_bti=[];
    $inscription_bts=[];
    $eleve_payer_bti=[];
    $eleve_non_payer_bti= [];
    $eleve_payer_bts=[];
    $eleve_non_payer_bts= [];
    $inscription_eleve_non_payant=[];
    $paiements = Paiement::with('eleve.inscription.classe', 'concerner.mois', 'concerner.annee_academique' , 'eleve.inscription.classe.unite_de_formation.departement');

   foreach($inscriptions as $inscription){
    if(($inscription->inscription->classe->type_classe == "FPJ" || $inscription->inscription->classe->type_classe == "CS")){
        foreach($paiements as $paiement){
            if($inscription->inscription->classe->type_formation->intitule == "BTI"  ){
                $inscription_bti []= $inscription->eleve;
                if($paiement->id_eleve == $inscription->eleve->id){
                    $eleve_payer_bti []= $paiement;
                }else{
                    $eleve_non_payer_bti []= $paiement;
                }                                                                                                                                                                                                                                                                                                                                                                       
            }else{
                $inscription_bts []= $inscription->eleve;
                if($paiement->id_eleve == $inscription->eleve->id){
                    $eleve_payer_bts []= $paiement;
                }else{
                    $eleve_non_payer_bts []= $paiement;
                }
            }
        }
    }else{
        $inscription_eleve_non_payant []= $inscription->eleve;
    }
   }
   if($inscriptions!=null){
    return response()->json([
        'statut'=>200,
        'eleve_payer_bti'=>$eleve_payer_bti,
        'eleve_non_payer_bti'=>$eleve_non_payer_bti,
        'eleve_payer_bts'=>$eleve_payer_bts,
        'eleve_non_payer_bts'=>$eleve_non_payer_bts

    ],200)  ;
}else{
    return response()->json([ 
        'statut'=>500,
        'message'=>'Aucune donnée trouvée',
    ],500 );
}
    }
}
