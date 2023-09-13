<?php

namespace App\Http\Controllers\emprunter_livre;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Emprunter_livre;
use App\Models\Livre;
use Illuminate\Http\Request;

class emprunter_livre_controller extends Controller
{
    //
    public function index()
    {
        $emprunts = Emprunter_livre::all();
        if($emprunts!=null){
            return response()->json([
                'statut'=>200,
                'emprunter'=>$emprunts
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun donner trouver',
            ],500 );
        } 
       // return view('emprunter_livre.index', ['emprunts' => $emprunts]);
    }
    public function show($id)
    {
        $emprunts = Emprunter_livre::find($id);
        if($emprunts!=null){
            return response()->json([
                'statut'=>200,
                'emprunts'=>$emprunts
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun donner trouver',
            ],500 );
        } 

    }
/*
    public function create()
    {
        $emprunts = Eleve::all();
        $livres = Livre::where('disponible', true)->get();
        $emprunt = Emprunter_livre::create([
        ]);
            //Affichez un formulaire pour permettre à l'utilisateur de sélectionner l'élève et le livre à emprunter
            //return view('emprunter_livre.create', ['emprunts$emprunts' => $emprunts, 'livres' => $livres]);
*/ 
    

    public function store(Request $request)
    {
        // Validez les données du formulaire ici
        $emprunts = Emprunter_livre::create([
            //'eleve_id' => $request['eleve_id'],
            //'livre_id' => $request['livre_id'],
            'date_emprunter' => now(),
            'id_bibliothecaire'=>$request['id_bibliothecaire'],
            'id_exemplaire'=>$request['id_exemplaire'],
            'Date_emprunter'=>$request['Date_emprunter'],
            'date_retour'=>$request['date_retour'],
        ]);

    /* 
        Mettez à jour le statut de disponibilité du livre
        $livre = Livre::find($request->input('livre_id'));
        $livre->disponible = false;
        $livre->save();

        return redirect()->route('emprunts.index')->with('success', 'Livre emprunté avec succès');
   */
    }

    public function rendre(Request $request, $id)
    {
        $emprunt = Emprunter_livre::find($id);

        if($emprunt!=null){
            return response()->json([
                'statut'=>200,
                $emprunt->date_retour = now(),
                $emprunt->save(),
                'emprunts'=>$emprunt
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun donner trouver',
            ],500 );
        } 

        
/*
        // Mettez à jour la date de retour et le statut de disponibilité du livre
        if (!$emprunt) {
            return redirect()->back()->with('error', 'Emprunt non trouvé');
        }

       // return redirect()->route('emprunts.index')->with('success', 'Livre rendu avec succès');
    
*/

    }
}
    