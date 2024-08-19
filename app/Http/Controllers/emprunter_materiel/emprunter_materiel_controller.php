<?php

namespace App\Http\Controllers\emprunter_materiel;

use App\Http\Controllers\Controller;
use App\Http\Requests\emprunter_materiel\emprunter_materiel_request;
use App\Models\emprunter_materiel;
use Illuminate\Http\Request;

class emprunter_materiel_controller extends Controller
{
    public function index()
    {
        $emprunts = emprunter_materiel::orderBy('created_at', 'desc')->get();
        return response()->json([
            'statut' => 200,
            'emprunts' => $emprunts
        ]);
    }

    public function store(emprunter_materiel_request $request)
    {
        $validatedData = $request->validated();
        $emprunt = emprunter_materiel::create($validatedData);
        return response()->json([
            'statut' => 201,
            'emprunt' => $emprunt
        ]);
    }

    public function update(emprunter_materiel_request $request, $id)
    {
        $emprunt = emprunter_materiel::find($id);
        if (!$emprunt) {
            return response()->json(['statut' => 404, 'message' => 'Emprunt de matériel non trouvé'], 404);
        }

        $validatedData = $request->validated();
        $emprunt->update($validatedData);
        return response()->json([
            'statut' => 200,
            'emprunt' => $emprunt
        ]);
    }

    public function destroy($id)
    {
        $emprunt = emprunter_materiel::find($id);
        if (!$emprunt) {
            return response()->json(['statut' => 404, 'message' => 'Emprunt de matériel non trouvé'], 404);
        }

        $emprunt->delete();
        return response()->json(['statut' => 200, 'message' => 'Emprunt de matériel supprimé avec succès']);
    }
}