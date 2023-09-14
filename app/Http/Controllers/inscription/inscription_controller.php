<?php

namespace App\Http\Controllers\inscription;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use Illuminate\Http\Request;

class inscription_controller extends Controller
{
    public function index()
    {
        
        $inscriptions = Inscription::all();

        return response()->json($inscriptions);
    }

    public function show($id)
    {
        
        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

        
        return response()->json($inscription);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'Montant' => 'required',
            'date_inscription' => 'required',
            'id_eleve' => 'required',
            'id_classe' => 'required',
            'id_annee_academique' => 'required',
           
        ]);

        
        $inscription = Inscription::create($validatedData);

        
        return response()->json($inscription, 201);
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'Montant' => 'required',
            'date_inscription' => 'required',
            'id_eleve' => 'required',
            'id_classe' => 'required',
            'id_annee_academique' => 'required',
            
        ]);

        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

        
        $inscription->update($validatedData);

        
        return response()->json($inscription);
    }

    public function destroy($id)
    {
        
        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

        
        $inscription->delete();

        
        return response()->json(['message' => 'Inscription supprimée avec succès']);
    }




}
