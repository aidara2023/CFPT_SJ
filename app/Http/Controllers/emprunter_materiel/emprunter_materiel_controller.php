<?php

namespace App\Http\Controllers\emprunter_materiel;

use App\Http\Controllers\Controller;
use App\Models\emprunter_materiel;
use Illuminate\Http\Request;

class emprunter_materiel_controller extends Controller
{
    public function index()
    {
        $emprunts = emprunter_materiel::all();

        return response()->json($emprunts);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'id_materiel' => 'required|integer',
            'id_user' => 'required|integer',
            'id_date_emprunt' => 'required|integer',
            'date_retour_prevue' => 'required|date',
            'date_retour_effective' => 'date|nullable',
            'statut' => 'required|string',
           
        ]);

        
        $emprunt = emprunter_materiel::create($validatedData);

        
        return response()->json($emprunt, 201);
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'id_materiel' => 'required|integer',
            'id_user' => 'required|integer',
            'id_date_emprunt' => 'required|integer',
            'date_retour_prevue' => 'required|date',
            'date_retour_effective' => 'date|nullable',
            'statut' => 'required|string',
            
        ]);

        
        $emprunt = emprunter_materiel::find($id);

        if (!$emprunt) {
            return response()->json(['message' => 'Emprunt de matériel non trouvé'], 404);
        }

        
        $emprunt->update($validatedData);

        
        return response()->json($emprunt);
    }

    public function destroy($id)
    {
        
        $emprunt = emprunter_materiel::find($id);

        if (!$emprunt) {
            return response()->json(['message' => 'Emprunt de matériel non trouvé'], 404);
        }

        
        $emprunt->delete();

        
        return response()->json(['message' => 'Emprunt de matériel supprimé avec succès']);
    }
}
