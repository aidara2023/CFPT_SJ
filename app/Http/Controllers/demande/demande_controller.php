<?php

namespace App\Http\Controllers\demande;

use App\Http\Controllers\Controller;
use App\Http\Requests\demande\demande_request;
use App\Models\Demande; // Assurez-vous que le modèle Demande existe
use Illuminate\Http\Request;

class demande_controller extends Controller
{
    public function index()
    {
        $demandes = Demande::orderBy('created_at', 'desc')->get();
        return response()->json([
            'statut' => $demandes->count() > 0 ? 200 : 500,
            'demandes' => $demandes->count() > 0 ? $demandes : null,
            'message' => $demandes->count() > 0 ? null : 'Aucune donnée trouvée',
        ]);
    }

    public function store(demande_request $request)
    {
        $data = $request->validated();
        $demande = Demande::create($data);
        return response()->json([
            'statut' => $demande ? 200 : 500,
            'demande' => $demande,
            'message' => $demande ? null : 'L\'enregistrement n\'a pas été effectué',
        ]);
    }

    public function update(demande_request $request, $id)
    {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }

        $data = $request->validated();
        $demande->update($data);

        return response()->json([
            'statut' => 200,
            'demande' => $demande
        ]);
    }

    public function destroy($id)
    {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }

        $demande->delete();
        return response()->json(['statut' => 200, 'message' => 'Demande supprimée avec succès']);
    }

    public function show($id)
    {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['statut' => 404, 'message' => 'Demande non trouvée'], 404);
        }

        return response()->json([
            'statut' => 200,
            'demande' => $demande
        ]);
    }
}