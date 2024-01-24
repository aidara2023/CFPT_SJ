<?php

namespace App\Http\Controllers\paiement;

use App\Http\Controllers\Controller;
use App\Http\Requests\paiement\paiement_request;
use App\Models\Caissier;
use App\Models\Classe;
use App\Models\Concerner;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\mois;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Type_formation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class paiement_controller extends Controller
{
    public function index(){
        $paiement = Paiement::with('eleve.user', 'eleve.inscription.classe', 'concerner.mois', 'concerner.annee_academique' )->orderBy('created_at', 'desc')->get();
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
         $request -> validated();
         $paiements= $request->input('paiements');
         $caissiers=Caissier::all();
         $eleves=Eleve::all();
         $concerner = null;
         if(!empty($paiements)){
        
             $paiements= json_decode($paiements, true);
             foreach($caissiers as $caissier){
                 if($caissier->id_user == Auth::user()->id){
                  
                     foreach($paiements as $paiement){
                         foreach($eleves as $eleve){
                             if($eleve->id_user==$request['id_eleve']){
                                 $dataPaiement= [
                                     'id_caissier'=>$caissier->id,
                                     'montant'=>$paiement['montant'],
                                     'id_eleve'=>$eleve->id,
                                 ];
                                
                                 $paiementValid= Paiement::create($dataPaiement);

                                 $dataConcerner= [
                                     'id_paiement'=>$paiementValid->id,
                                     'id_mois'=>$paiement['id_mois'],
                                     'id_annee_academique'=>$paiement['id_annee_academique'],
                                     'statut'=>1,
                                 ];

                                 $concerner=Concerner::create($dataConcerner);
                             }
                         }

                     }

                 }
             }
             if($concerner != null){
                 return response()->json([
                     'statut' => 200,
                     'paiement' => $concerner
                 ],200);
             } else {
                 return response()->json([
                     'statut' => 600,
                     'message' => 'L\'enregistrement n\'a pas été éffectué'
                 ],500);
             }
         }
         else {
             return response()->json([
                 'statut' => 500,
                 'message' => 'L\'enregistrement n\'a pas été éffectué'
             ],500);
        }
    }

  /*   public function store(paiement_request $request) {
        $data = $request -> validated();
        $classes=[];
        $request->validated();
        $paiement=new paiement();
        $caissiers=Caissier::all();

        $inscriptions=Inscription::where('id_eleve',$request['id_eleve'])->get();
        foreach($inscriptions as $inscription){
            $classes=Classe::with('type_formation')->where('id', $inscription->id_classe)->get();
            foreach($classes as $classe){
                if($classe->type_formation->intitule=="BTS"){
                    $latestPayment = Paiement::where('id_eleve', $request['id_eleve'])->latest('created_at')->first();
                    if($latestPayment->montant < 70000){
                        $montant=$request['montant'];
                        $differenceMontant= $montant - $latestPayment->montant;
                        $latestPayment->montant=$latestPayment->montant + $differenceMontant;
                        $latestPayment->save();


                        $latestconcern=concerner::where('id_paiement', $latestPayment->id)->latest('created_at')->first();
                        $moisregler= $latestconcern->id_mois;
                        $moisNext=mois::find($moisregler);
                        if($differenceMontant >= 70000){
                            $j=$moisNext->id + 1;
                            while($differenceMontant >= 70000){
                                $montant= $differenceMontant - 70000;

                                foreach($caissiers as $caissier){
                                    if($caissier->id_user == Auth::user()->id){
                                        $paiement->id_caissier=$caissier->id;
                                        $paiement->montant=70000;
                                        $paiement->id_eleve=$request['id_eleve'];
                                        $paiement->save();

                                        $concerner= new concerner();
                                        $concerner->id_paiement=$paiement->id;
                                        $concerner->id_mois=$j;
                                        $concerner->statut=1;
                                        $concerner->id_annee_academique=$request['id_annee_academique'];
                                        $concerner->save();

                                      }
                                }
                                $j++;
                            }
                            if($montant< 70000 AND $montant!=0){
                                foreach($caissiers as $caissier){
                                    if($caissier->id_user == Auth::user()->id){
                                        $paiement->id_caissier=$caissier->id;
                                        $paiement->montant=$montant;
                                        $paiement->id_eleve=$request['id_eleve'];
                                        $paiement->save();

                                        $concerner= new concerner();
                                        $concerner->id_paiement=$paiement->id;
                                        $concerner->id_mois=$j;
                                        $concerner->statut=2;
                                        $concerner->id_annee_academique=$request['id_annee_academique'];
                                        $concerner->save();

                                      }
                                }
                            }
                        }
                    }else{
                        $montant=$request['montant'];
                        $i=0;
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
                        if($montant< 70000 AND $montant!=0 ){
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=$montant;
                                    $paiement->id_eleve=$request['id_eleve'];
                                    $paiement->save();

                                    $concerner= new concerner();
                                    $concerner->id_paiement=$paiement->id;
                                    $concerner->id_mois=$i + 1;
                                    $concerner->statut=2;
                                    $concerner->id_annee_academique=$request['id_annee_academique'];
                                    $concerner->save();

                                  }
                            }
                        }
                    }
                }else{
                    $latestPayment = Paiement::where('id_eleve', $request['id_eleve'])->latest('created_at')->first();
                    if($latestPayment->montant < 50000){
                        $montant=$request['montant'];
                        $differenceMontant= $montant - $latestPayment->montant;
                        $latestPayment->montant=$latestPayment->montant + $differenceMontant;
                        $latestPayment->save();


                        $latestconcern=concerner::where('id_paiement', $latestPayment->id)->latest('created_at')->first();
                        $moisregler= $latestconcern->id_mois;
                        $moisNext=mois::find($moisregler);
                        if($differenceMontant >= 50000){
                            $j=$moisNext->id + 1;
                            while($differenceMontant >= 50000){
                                $montant= $differenceMontant - 50000;

                                foreach($caissiers as $caissier){
                                    if($caissier->id_user == Auth::user()->id){
                                        $paiement->id_caissier=$caissier->id;
                                        $paiement->montant=50000;
                                        $paiement->id_eleve=$request['id_eleve'];
                                        $paiement->save();

                                        $concerner= new concerner();
                                        $concerner->id_paiement=$paiement->id;
                                        $concerner->id_mois=$j;
                                        $concerner->statut=1;
                                        $concerner->id_annee_academique=$request['id_annee_academique'];
                                        $concerner->save();

                                      }
                                }
                                $j++;
                            }
                            if($montant< 50000 AND $montant!=0){
                                foreach($caissiers as $caissier){
                                    if($caissier->id_user == Auth::user()->id){
                                        $paiement->id_caissier=$caissier->id;
                                        $paiement->montant=$montant;
                                        $paiement->id_eleve=$request['id_eleve'];
                                        $paiement->save();

                                        $concerner= new concerner();
                                        $concerner->id_paiement=$paiement->id;
                                        $concerner->id_mois=$j;
                                        $concerner->statut=2;
                                        $concerner->id_annee_academique=$request['id_annee_academique'];
                                        $concerner->save();

                                      }
                                }
                            }
                        }
                    }else{
                        $montant=$request['montant'];
                        $i=0;
                        while($montant>= 50000){
                            $montant= $montant - 50000;
                            $i++;
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=50000;
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
                        if($montant< 50000 AND $montant!=0 ){
                            foreach($caissiers as $caissier){
                                if($caissier->id_user == Auth::user()->id){
                                    $paiement->id_caissier=$caissier->id;
                                    $paiement->montant=$montant;
                                    $paiement->id_eleve=$request['id_eleve'];
                                    $paiement->save();

                                    $concerner= new concerner();
                                    $concerner->id_paiement=$paiement->id;
                                    $concerner->id_mois=$i + 1;
                                    $concerner->statut=2;
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
    } */



    public function processOtherFormation($request, $caissiers)
    {
        // Implement the logic for other formation types here
    }

    public function createPaiementAndConcerner($caissiers, $idEleve, $montant, $mois, $statut, $idAnneeAcademique)
    {
        foreach ($caissiers as $caissier) {
            if ($caissier->id_user == Auth::user()->id) {
                $paiement = new Paiement();
                $paiement->id_caissier = $caissier->id;
                $paiement->montant = $montant;
                $paiement->id_eleve = $idEleve;
                $paiement->save();

                $concerner = new Concerner();
                $concerner->id_paiement = $paiement->id;
                $concerner->id_mois = $mois;
                $concerner->statut = $statut;
                $concerner->id_annee_academique = $idAnneeAcademique;
                $concerner->save();
            }
        }

    }

    public function processBTSFormation($request, $caissiers, $montantSaisi, $annee)
    {
        $latestPayment = Paiement::where('id_eleve', $request)->latest('created_at')->get();

        // dd($annee);
        // dd($latestPayment);
        if ($latestPayment->count()!=0) {

            if($latestPayment->montant < 70000){
                $montant = $montantSaisi;
                $differenceMontant = $montant - $latestPayment->montant;
                $latestPayment->montant = $latestPayment->montant + $differenceMontant;
                $latestPayment->save();

                $latestConcern = Concerner::where('id_paiement', $latestPayment->id)->latest('created_at')->first();
                $moisRegler = $latestConcern->id_mois;
                $moisNext = Mois::find($moisRegler);
                $j = $moisNext->id;

                while ($differenceMontant >= 70000) {
                    $differenceMontant = $differenceMontant - 70000;
                    $j++;
                    return $this->createPaiementAndConcerner($caissiers, $request, 70000, $j, 1, $annee);
                }

                if ($differenceMontant < 70000 && $differenceMontant != 0) {
                    return $this->createPaiementAndConcerner($caissiers, $request, $montant, $j, 2, $annee);
                }
            }else {
                // Process BTS formation when montant >= 70000
                // return 0;
            }
        }else{
            $j=0;
            while ($montantSaisi >= 70000) {
                $montantSaisi = $montantSaisi - 70000;
                $j++;
                 $this->createPaiementAndConcerner($caissiers, $request, 70000, $j, 1, $annee);
            }

            if ($montantSaisi < 70000 && $montantSaisi != 0) {
                 $this->createPaiementAndConcerner($caissiers, $request, $montantSaisi, $j+1, 2, $annee);
            }
        }
    }


    public function storeOld(paiement_request $request){
        $data = $request->validated();
        $caissiers = Caissier::all();
        // dd($caissiers);
        $inscriptions = Inscription::where('id_eleve', $request['id_eleve'])->get();

        foreach ($inscriptions as $inscription) {
            $classes = Classe::with('type_formation')->where('id', $inscription->id_classe)->get();



            foreach ($classes as $classe) {

                if ($classe->type_formation->intitule == "BTS Jour" OR $classe->type_formation->intitule == "BTS Soir") {
                    /* dd($caissiers); */
                    $paiement=$this->processBTSFormation($request['id_eleve'], $caissiers, $request['montant'], $request['id_annee_academique']);

                    if ($paiement != null) {
                        return response()->json([
                            'statut' => 200,
                            'paiement' => $paiement
                        ], 200);
                    } else {
                        return response()->json([
                            'statut' => 500,
                            'message' => 'L\'enregistrement n\'a pas été effectué'
                        ], 500);
                    }

                } else {
                    /* $paiement=$this->processOtherFormation($request, $caissiers); */
                    // dd("erreur");
                }
            }
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


    public function destroy($id) {
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


/*     public function recherche_eleve(Request $request){
        $valeur=$request->input('query');

            $user= User::with('eleves.inscription.classe')->where('matricule','LIKE', "%$valeur%")->get();
            // .inscriptions.classe
        if($user != null){
            return response()->json( $user);
        }else{
            return response() -> json([
                'statut' => 500,
                'eleve' => 'Ce matricule n\'existe pas'
            ],500);
        }
    } */

    public function recherche_eleve(Request $request){
        $valeur = $request->input('query');
    
        $users = User::with('eleves.inscription.classe')
            ->whereHas('role', function ($query) {
                // Filtrer les utilisateurs ayant un rôle avec id_role élevé
                $query->where('id_role', 1); // Assurez-vous de remplacer $valeur par la valeur souhaitée
            })
            ->where('matricule', 'LIKE', "%$valeur%")
            ->get();
    
        if ($users->isNotEmpty()) {
            return response()->json($users);
        } else {
            return response()->json([
                'statut' => 500,
                'eleve' => 'Aucun utilisateur ne correspond à la recherche',
            ], 500);
        }
    }
    

}
