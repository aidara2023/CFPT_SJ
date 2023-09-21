<?php

namespace App\Http\Controllers\inscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\inscription\inscription_request;
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
        $user=User::create($data);
        $inscription=Inscription::create([
            'montant'=>$request->montant,
            'date_inscription'=>$request->date_inscription,
            'id_eleve'=>$request->id_eleve,
            'id_classe'=>$request->id_classe,
            'id_annee_academique'=>$request->id_annee_academique
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
