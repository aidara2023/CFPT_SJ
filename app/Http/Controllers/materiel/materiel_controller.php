<?php

namespace App\Http\Controllers\materiel;

use App\Http\Controllers\Controller;
use App\Http\Requests\materiel\materiel_request;
use App\Models\Materiel;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class materiel_controller extends Controller
{
    
    public function index()
    {
        Log::info('Récupération des matériels');
        $materiels = Materiel::all();
        Log::info('Materiels récupérés:', ['materiels' => $materiels]);
        return response()->json(['materiels' => $materiels]);
    }

    public function store(materiel_request $request)
    {
        $data = $request->validated();
        $materiel = Materiel::create($data);
        return response()->json([
            'statut' => $materiel ? 200 : 500,
            'materiel' => $materiel,
            'message' => $materiel ? null : 'L\'enregistrement n\'a pas été effectué',
        ]);
    }

    public function update(materiel_request $request, $id)
    {
        $materiel = Materiel::find($id);
        if (!$materiel) {
            return response()->json(['statut' => 404, 'message' => 'Le matériel n\'existe pas'], 404);
        }

        $data = $request->validated();
        $materiel->update($data);

        return response()->json([
            'statut' => 200,
            'materiel' => $materiel
        ]);
    }

    public function destroy($id)
    {
        $materiel = Materiel::find($id);
        if (!$materiel) {
            return response()->json(['statut' => 404, 'message' => 'Le matériel n\'existe pas'], 404);
        }

        $materiel->delete();
        return response()->json(['statut' => 200, 'message' => 'Matériel supprimé avec succès']);
    }

    public function show($id)
    {
        $materiel = Materiel::find($id);
        if (!$materiel) {
            return response()->json(['statut' => 404, 'message' => 'Le matériel n\'existe pas'], 404);
        }

        return response()->json([
            'statut' => 200,
            'materiel' => $materiel
        ]);
    }
}