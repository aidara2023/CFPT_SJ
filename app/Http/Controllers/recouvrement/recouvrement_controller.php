<?php

namespace App\Http\Controllers\recouvrement;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Paiement;
use Illuminate\Http\Request;

class recouvrement_controller extends Controller
{
    public function filtre(Request $request){
        $id_annee_academique=$request->input('id_annee_academique');
        $id_mois=$request->input('id_mois');
        $id_departement=$request->input('id_depertement');
        $id_unite_de_formation=$request->input('id_unite_de_formation');
        $id_classe=$request->input('id_classe');

        $inscriptions=Eleve:: with('inscription.classe.type_formation', 'eleve.user')->get(); 

        $filters = $request->all();
        $eleve_non_payers= [];
        $inscription_eleve_non_payant=[];
        $query = Paiement::with('eleve.inscription.classe', 'concerner.mois', 'concerner.annee_academique' , 'eleve.inscription.classe.unite_de_formation.departement');

   foreach($inscriptions as $inscription){
    if(($inscription->inscription->classe->type_classe == "FPJ" || $inscription->inscription->classe->type_classe == "CS")){
        foreach($query as $paiement){
          /*   if($inscription->inscription->classe->type_formation->intitule == "BTI"  ){
                $inscription_bti []= $inscription->eleve; */
                if($paiement->id_eleve != $inscription->eleve->id){
                    foreach ($filters as $filterName => $filterValues) {
                        if (!empty($filterValues)) {
                            switch ($filterName) {
                                case 'id_annee_academique':
                                    $query->whereHas('concerner.annee_academique', function ($query) use ($filterValues) {
                                        $query->whereIn('id', $filterValues);
                                    });
                                    break;
            
                                case 'id_mois':
                                    $query->whereHas('concerner.mois', function ($query) use ($filterValues) {
                                        $query->whereIn('id', $filterValues);
                                    });
                                    break;
            
                                case 'id_departement':
                                    $query->whereHas('eleve.inscription.classe.unite_de_formation.departement', function ($query) use ($filterValues) {
                                        $query->whereIn('id', $filterValues);
                                    });
                                    break;

                                case 'id_unite_de_formation':
                                    $query->whereHas('eleve.inscription.classe.unite_de_formation', function ($query) use ($filterValues) {
                                        $query->whereIn('id', $filterValues);
                                    });
                                    break;

                                    case 'id_classe':
                                        $query->whereHas('eleve.inscription.classe', function ($query) use ($filterValues) {
                                            $query->whereIn('id', $filterValues);
                                        });
                                        break;
            
                                // Ajoutez d'autres cas pour d'autres critères de filtrage...
            
                                default:
                                    // Gérer d'autres cas si nécessaire...
                                    break;
                            }
                        }
                    }
            
                    $eleve_non_payers = $query->get();
                }
               /*  else{
                    $eleve_non_payer_bti []= $paiement;
                }  */                                                                                                                                                                                                                                                                                                                                                                      
          /*   }else{ */
             /*    $inscription_bts []= $inscription->eleve;
                if($paiement->id_eleve == $inscription->eleve->id){
                    $eleve_payer_bts []= $paiement;
                } */
                /* else{
                    $eleve_non_payer_bts []= $paiement;
                } */
           /*  } */
        }
    }else{
        $inscription_eleve_non_payant []= $inscription->eleve;
    }
   }
   if($inscriptions!=null){
    return response()->json([
        'statut'=>200,
       
        'eleve_non_payer'=>$eleve_non_payers,
        

    ],200)  ;
}else{
    return response()->json([ 
        'statut'=>500,
        'message'=>'Aucune donnée trouvée',
    ],500 );
}
    }
}
