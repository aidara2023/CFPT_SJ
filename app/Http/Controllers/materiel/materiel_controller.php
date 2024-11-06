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
    try {
        $materiels = Materiel::with(['etat', 'typeMateriel', 'departement', 'demande'])->orderBy('created_at', 'desc')->get();
        if ($materiels->isNotEmpty()) {
            return response()->json([
                'statut' => 200,
                'materiels' => $materiels
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    } catch (\Exception $e) {
        Log::error('Erreur lors de la récupération des matériels: ' . $e->getMessage());
        return response()->json([
            'statut' => 500,
            'message' => 'Une erreur est survenue lors de la récupération des matériels.',
        ], 500);
    }
}
    
    public function store(materiel_request $request)
    {
        try {
            $data = $request->validated();
            $materiel = Materiel::create($data);
            return response()->json([
                'statut' => 200,
                'materiel' => $materiel,
                'message' => null,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du matériel: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de la création du matériel.',
            ], 500);
        }
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
    public function search(Request $request)
{
    $perPage = $request->has('per_page') ? $request->per_page : 15;
    $search = $request->has('search') ? $request->search : '';

    $materiels = Materiel::with(['etat', 'typeMateriel', 'departement', 'demande'])
        ->where('libelle', 'LIKE', "%{$search}%")
        ->orWhere('marque', 'LIKE', "%{$search}%")
        ->orWhereHas('etat', function($query) use ($search) {
            $query->where('intitule', 'LIKE', "%{$search}%");
        })
        ->orWhereHas('typeMateriel', function($query) use ($search) {
            $query->where('intitule', 'LIKE', "%{$search}%");
        })
        ->orWhereHas('departement', function($query) use ($search) {
            $query->where('nom_departement', 'LIKE', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);

    if ($materiels->isNotEmpty()) {
        return response()->json([
            'statut' => 200,
            'materiels' => $materiels
        ], 200);
    } else {
        return response()->json([
            'statut' => 500,
            'message' => 'Aucun matériel trouvé',
        ], 500);
    }
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