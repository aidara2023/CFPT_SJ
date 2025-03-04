<?php

namespace App\Http\Controllers\statut;

use App\Http\Controllers\Controller;
use App\Http\Requests\statut\statut_request;
use App\Models\Statut; // Assurez-vous que le modèle Statut existe
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importer la façade Log

class statut_controller extends Controller
{
    public function index()
    {
        $statuts = Statut::all(); // Récupérer tous les statuts
        Log::info('Récupération de tous les statuts.', ['statuts' => $statuts]);
        return response()->json($statuts);
    }

    public function show($id)
    {
        $statut = Statut::find($id);

        if (!$statut) {
            Log::warning('Statut non trouvé.', ['id' => $id]);
            return response()->json(['message' => 'Statut non trouvé'], 404);
        }

        Log::info('Statut trouvé.', ['statut' => $statut]);
        return response()->json($statut);
    }

    public function store(statut_request $request)
{
    Log::info('Requête reçue pour la création d\'un statut.', ['request_data' => $request->all()]);

    $validatedData = $request->validated();
    Log::info('Données validées pour le nouveau statut.', ['validated_data' => $validatedData]);

    try {
        $newStatut = Statut::create($validatedData);
        Log::info('Statut créé avec succès.', ['statut' => $newStatut]);

        return response()->json($newStatut, 201);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la création du statut.', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Erreur lors de la création du statut.'], 500);
    }
}
    public function update(statut_request $request, $id)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|string',
        ]);

        $statut = Statut::find($id);

        if (!$statut) {
            Log::warning('Tentative de mise à jour d\'un statut non trouvé.', ['id' => $id]);
            return response()->json(['message' => 'Statut non trouvé'], 404);
        }

        $statut->update($validatedData);
        Log::info('Statut mis à jour avec succès.', ['statut' => $statut]);

        return response()->json($statut);
    }

    public function destroy($id)
    {
        $statut = Statut::find($id);

        if (!$statut) {
            Log::warning('Tentative de suppression d\'un statut non trouvé.', ['id' => $id]);
            return response()->json(['message' => 'Statut non trouvé'], 404);
        }

        $statut->delete();
        Log::info('Statut supprimé avec succès.', ['id' => $id]);

        return response()->json(['message' => 'Statut supprimé avec succès']);
    }
}