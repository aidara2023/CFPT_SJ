<?php

namespace App\Http\Controllers\inscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\inscription\inscription_request;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\User;
use Illuminate\Http\Request;

class inscription_controller extends Controller
{
    public function index() {
        $inscription=Inscription::all();
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

     public function show($id){

        $inscription=Inscription::find($id);
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Inscription introuvable ',
            ],500 );
        }
    }

    public function store (inscription_request $request){
        $data=$request->validated();
        $tuteur=User::create([
            'nom'=>$data->nom_tuteur,
            'prenom'=>$data->prenom_tuteur,
            'genre'=>$data->genre_tuteur,
            'adresse'=>$data->adresse_tuteur,
            'telephone'=>$data->telephone_tuteur,
            'date_naissance'=>$data->date_naissance_tuteur,
            'lieu_naissance'=>$data->lieu_naissance_tuteur,
            'nationalite'=>$data->nationalite_tuteur
        ]);
        $eleve_user=User::create([
            'nom'=>$data->nom_eleve,
            'prenom'=>$data->prenom_eleve,
            'genre'=>$data->genre_eleve,
            'adresse'=>$data->adresse_eleve,
            'telephone'=>$data->telephone_eleve,
            'date_naissance'=>$data->date_naissance_eleve,
            'lieu_naissance'=>$data->lieu_naissance_eleve,
            'nationalite'=>$data->nationalite_eleve
        ]);
        $eleve=Eleve::create([
        'contact_urgence1'=>$data->contact_urgence1,
        'contact_urgence2'=>$data->contact_urgence2,
        'id_tuteur'=>$tuteur->id,
        'id_user'=>$eleve_user->id
       
        ]);
        $inscription=Inscription::create([
            'montant'=>$data->montant,
            'date_inscription'=>now(),
            'id_eleve'=>$eleve->id,
            'id_classe'=>$data->id_classe,
            'id_annee_academique'=>$data->id_annee_academique
        ]);
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'inscription est introuvable',
            ],500 );
        }
    }

    public function update(inscription_request $request, $id)
    {
        
        $validatedData = $request->validated();

        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

        
        $inscription->update($validatedData);

        
        return response()->json($inscription);
    }

    public function delete($id)
    {
        
        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

        
        $inscription->delete();

        
        return response()->json(['message' => 'Inscription supprimée avec succès']);
    }




}
