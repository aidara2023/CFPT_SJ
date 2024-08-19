<?php

namespace App\Http\Controllers\statut;

use App\Http\Controllers\Controller;
use App\Http\Requests\statut\statut_request;
use App\Models\Statut; // Assurez-vous que le modèle Statut existe
use Illuminate\Http\Request;

class statut_controller extends Controller
{
    public function index()
    {
        $statuts = Statut::orderBy('created_at', 'desc')->get();
        return response()->json([
            'statut' => 200,
            'statuts' => $statuts,
            'message' => $statuts->isEmpty() ? 'Aucune donnée trouvée' : null,
        ]);
    }
    public function store(statut_request $request)
    {
        $data = $request->validated();
        $statut = Statut::create($data);
        return response()->json([
            'statut_code' => $statut ? 200 : 500, 
            'statut' => $statut,
            'message' => $statut ? null : 'L\'enregistrement n\'a pas été effectué',
        ]);
    }

    public function update(statut_request $request, $id)
    {
        $statut = Statut::find($id);
        if (!$statut) {
            return response()->json(['statut_code' => 404, 'message' => 'Statut non trouvé'], 404); // Changement de 'statut' à 'statut_code'
        }

        $data = $request->validated();
        $statut->update($data);

        return response()->json([
            'statut_code' => 200, 
            'statut' => $statut
        ]);
    }

    public function destroy($id)
    {
        $statut = Statut::find($id);
        if (!$statut) {
            return response()->json(['statut' => 404, 'message' => 'Statut non trouvé'], 404);
        }

        $statut->delete();
        return response()->json(['statut' => 200, 'message' => 'Statut supprimé avec succès']);
    }

    
    public function show($id)
    {
        $statut = Statut::find($id);
        if (!$statut) {
            return response()->json(['statut_code' => 404, 'message' => 'Statut non trouvé'], 404); 
        }

        return response()->json([
            'statut_code' => 200, 
            'statut' => $statut
        ]);
    }
}