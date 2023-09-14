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
        $data = $request->validate([
            'id_user' => 'required',
            'id_bibliothecaire' => 'required',
            'id_exemplaire' => 'required',
            'Date_emprunter' => 'required',
            'date_retour' => 'required',
        ]);

        $emprunt = Emprunter_Livre::create($data);
        if ($emprunt) {
            return response()->json([
                'status' => 200,
                'emprunt' => $emprunt
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'enregistrement n\'a pas été effectué',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $emprunt = Emprunter_Livre::find($id);
        if ($emprunt) {
            $data = $request->validate([
                'id_user' => 'required',
                'id_bibliothecaire' => 'required',
                'id_exemplaire' => 'required',
                'Date_emprunter' => 'required',
                'date_retour' => 'required',
            ]);

            $emprunt->update($data);

            return response()->json([
                'status' => 200,
                'emprunt' => $emprunt
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'La mise à jour n\'a pas été effectuée',
            ], 500);
        }
    }

    public function destroy($id)
    {
        $emprunt = Emprunter_Livre::find($id);
        if ($emprunt) {
            $emprunt->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Emprunt supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'emprunt n\'a pas été supprimé',
            ], 500);
        }
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
    }

        
/*
        // Mettez à jour la date de retour et le statut de disponibilité du livre
        if (!$emprunt) {
            return redirect()->back()->with('error', 'Emprunt non trouvé');
        }

       // return redirect()->route('emprunts.index')->with('success', 'Livre rendu avec succès');
    
*/

    
}
    