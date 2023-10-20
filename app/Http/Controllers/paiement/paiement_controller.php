<?php

namespace App\Http\Controllers\paiement;

use App\Http\Controllers\Controller;
use App\Http\Requests\paiement\paiement_request;
use App\Models\Caissier;
use App\Models\Classe;
use App\Models\concerner;
use App\Models\Inscription;
use App\Models\mois;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Type_formation;
use Illuminate\Support\Facades\Auth;

class paiement_controller extends Controller
{
    public function index(){
        $paiement = Paiement::all();
        if($paiement != null){
            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée'
            ],500);
        }
    }

    public function store(paiement_request $request) {
        $data = $request -> validated();
        $classes=[];
        $request->validated();
        $paiement=new paiement();
        $caissiers=Caissier::all();

        $inscriptions=Inscription::where('id_eleve',$request['id_eleve'])->get();
        foreach($inscriptions as $inscription){
            $classes=Classe::with('type_formation')->where('id', $inscription->id_classe)->get();
            foreach($classes as $classe){
                if($classe->intitule=="BTS"){
                    $latestPayment = Paiement::where('id_eleve', $request['id_eleve'])->latest('created_at')->first();
                    if($latestPayment < 70000){

                    }else{
                        $montant=$request['montant'];
                        $i=0;
                     /*    $rest= $request['montant'] - 70000 * $nombre; */
                        while($montant>= 70000){
                            $montant= $montant - 70000;
                            $i++;
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=70000;
                                    $paiement->id_eleve=$request['id_eleve'];
                                    $paiement->save();
                        
                                    $concerner= new concerner();
                                    $concerner->id_paiement=$paiement->id;
                                    $concerner->id_mois=$i + 1;
                                    $concerner->statut=1;
                                    $concerner->id_annee_academique=$request['id_annee_academique'];
                                    $concerner->save();
                            
                                  }
                            }
                        }
                        if($montant< 70000){
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=$montant;
                                    $paiement->id_eleve=$request['id_eleve'];
                                    $paiement->save();
                        
                                    $concerner= new concerner();
                                    $concerner->id_paiement=$paiement->id;
                                    $concerner->id_mois=$i + 1;
                                    $concerner->statut=1;
                                    $concerner->id_annee_academique=$request['id_annee_academique'];
                                    $concerner->save();
                            
                                  }
                            }
                        }
                    }
                }else{
                    $latestPayment = Paiement::where('id_eleve', $request['id_eleve'])->latest('created_at')->first();
                    if($latestPayment < 70000){

                    }else{
                        $montant=$request['montant'];
                        $i=0;
                     /*    $rest= $request['montant'] - 70000 * $nombre; */
                        while($montant>= 70000){
                            $montant= $montant - 70000;
                            $i++;
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=70000;
                                    $paiement->id_eleve=$request['id_eleve'];
                                    $paiement->save();
                        
                                    $concerner= new concerner();
                                    $concerner->id_paiement=$paiement->id;
                                    $concerner->id_mois=$i + 1;
                                    $concerner->statut=1;
                                    $concerner->id_annee_academique=$request['id_annee_academique'];
                                    $concerner->save();
                            
                                  }
                            }
                        }
                        if($montant< 0){
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=70000;
                                    $paiement->id_eleve=$request['id_eleve'];
                                    $paiement->save();
                        
                                    $concerner= new concerner();
                                    $concerner->id_paiement=$paiement->id;
                                    $concerner->id_mois=$i + 1;
                                    $concerner->statut=1;
                                    $concerner->id_annee_academique=$request['id_annee_academique'];
                                    $concerner->save();
                            
                                  }
                            }
                        }
                    }
                }
            }
        }

        if($paiement != null){
            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function update(paiement_request $request, $id) {
        $paiement = Paiement::find($id);
        if($paiement != null){
            $paiement -> id_paiement = $request['id_paiement'];
            $paiement -> id_eleve = $request['id_eleve'];
            $paiement -> id_caissier = $request['id_caissier'];
            $paiement -> id_annee_academique = $request['id_annee_academique'];
            $paiement -> mois = $request['mois'];
            $paiement -> save();

            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function delete($id) {
        $paiement = Paiement::find($id);
        if($paiement != null){
            $paiement -> delete();
            return response()->json([
                'statut' => 200,
                'message' => 'L\'enregistrement a été supprimé avec succés'
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été supprimé'
            ],500);
        }
    }

    public function show($id) {
        $paiement = Paiement::find($id);
        if($paiement != null){
            return response()->json([
                'statut' => 200,
                'paiement' => $paiement
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'paiement' => 'Cet enregistrement n\'existe pas'
            ],500);
        }
    }
}
