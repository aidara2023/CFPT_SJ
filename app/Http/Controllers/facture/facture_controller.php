<?php

namespace App\Http\Controllers\facture;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Http\Request;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use Illuminate\Support\Facades\Auth;

class facture_controller extends Controller
{
    public function index() {
        $facture=Facture::with('location.partenaire', 'user','location.salle')->orderBy('created_at', 'desc')->get();
        if($facture!=null){
            return response()->json([
                'statut'=>200,
                'facture'=>$facture
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

     public function get_five_laste() {
        $factures = Facture::with('user', 'location')
            ->orderBy('created_at', 'desc')
            ->take(5) // Ajout de cette ligne pour récupérer les 5 derniers enregistrements
            ->get();
    
        if ($factures->count() > 0) {
            return response()->json([
                'statut' => 200,
                'facture' => $factures
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }
    

    public function store(Request $request){
        /* 'type',
        'objet',
        'montant_payer',
        'date_facture',
        'id_location', */

        
        //$verification =Facture::where('nom_facture', $request['nom_facture'])->get();
       
      /*   if($verification->count()!=0){
            return response()->json([ 
                'statut'=>404,
                'message'=>'Ce facture existe déja',
            ],404 );
        }else{ */
        $facture=Facture::create([
            'type'=> $request->type,
            'objet'=>$request->objet,
            'montant_payer'=>$request->montant_payer,
            'id_location'=>$request->id_location,
            'id_reservation'=>$request->id_reservation,
            'date_facture'=>$request->date_facture,
            'id_user'=>$request->id_user
        ]);
        if($facture!=null){ 
            event(new ModelCreated($facture));
            return response()->json([
                'statut'=>200,
                'facture'=>$facture
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été ajouté',
            ],500 );
        }
    //}
}
    public function update(Request $request, $id){
        $facture=Facture::find($id);
        if($facture!=null){
           $facture->type=$request['type'];
           $facture->objet=$request['objet'];
           $facture->montant_payer=$request['montant_payer'];
           $facture->date_facture=$request['date_facture'];
           $facture->id_location=$request['id_location'];
           $facture->id_user=Auth::user()->id;
          
           $facture->save();
           event(new ModelUpdated($facture));
            return response()->json([
                'statut'=>200,
                'facture'=>$facture
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $facture=Facture::find($id);
        if($facture!=null){
            $facture->delete();
            event(new ModelDeleted($facture));
            return response()->json([
                'statut'=>200,
                'message'=>'Facture supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La Facture n\'est pas supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $facture=Facture::with('location.partenaire', 'user', 'location.salle', 'reservation')->find($id);
        if($facture!=null){
            return response()->json([
                'statut'=>200,
                'facture'=>$facture
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'facture non enregistré',
            ],500 );
        }
       
    }
}
