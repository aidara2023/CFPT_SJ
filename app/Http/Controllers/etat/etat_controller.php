<?php

namespace App\Http\Controllers\etat;

use App\Http\Requests\etat\etat_request;

use App\Http\Controllers\Controller;
use App\Models\Etat;
use Illuminate\Http\Request;

class etat_controller extends Controller
{
    public function index()
    {
        $etats=Etat::orderBy('created_at', 'desc')->get();
        if($etats!=null){
            return response()->json([
                'statut'=>200,
                'etats'=>$etats
            ],200);
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
    }


    // SecteurActiviteController.php


    

    public function show($id)
    {
        $etat = Etat::find($id);
        if (!$etat) {
            return response()->json(['message' => 'État non trouvé'], 404);
        }
        return response()->json($etat);
    }

    public function store(etat_request $request)
    {
        $validatedData = $request->validated();
        $etat = Etat::create($validatedData);
        return response()->json($etat, 201);
    }

    public function update(etat_request $request, $id)
    {
        $etat = Etat::find($id);
        if (!$etat) {
            return response()->json(['message' => 'État non trouvé'], 404);
        }
        $etat->update($request->validated());
        return response()->json($etat);
    }

    public function destroy($id)
    {
        $etat = Etat::find($id);
        if (!$etat) {
            return response()->json(['message' => 'État non trouvé'], 404);
        }
        $etat->delete();
        return response()->json(['message' => 'État supprimé avec succès']);
    }
}