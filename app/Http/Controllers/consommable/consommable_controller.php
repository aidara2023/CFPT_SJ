<?php

namespace App\Http\Controllers\consommable;

use App\Http\Controllers\Controller;
use App\Http\Requests\consommable\consommable_request;
use App\Models\Consommable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class consommable_controller extends Controller
{
    public function index()
    {
        try {
            $consommables = Consommable::with(['etat', 'departement','commande'])->orderBy('created_at', 'desc')->get();
            if ($consommables->isNotEmpty()) {
                return response()->json([
                    'statut' => 200,
                    'consommables' => $consommables
                ], 200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'Aucune donnée trouvée',
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des consommables: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de la récupération des consommables.',
            ], 500);
        }
    }

    public function store(consommable_request $request)
    {
        
 
        try {
            $data = $request->validated();
            $consommable = Consommable::create($data);
            return response()->json([
                'statut' => 200,
                'consommable' => $consommable,
                'message' => null,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du consommable: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de la création du consommable.',
            ], 500);
        }
    }


    public function search(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->per_page : 15;
        $search = $request->has('search') ? $request->search : '';
    
        $consommables = Consommable::with(['etat', 'departement', 'commande']) // Changé de 'demande' à 'commande'
            ->where('libelle', 'LIKE', "%{$search}%")
            ->orWhere('marque', 'LIKE', "%{$search}%")
            ->orWhereHas('etat', function($query) use ($search) {
                $query->where('intitule', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('departement', function($query) use ($search) {
                $query->where('nom_departement', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('commande', function($query) use ($search) { // Ajout de la recherche sur commande
                $query->where('reference_commande', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    
        if ($consommables->isNotEmpty()) {
            return response()->json([
                'statut' => 200,
                'consommables' => $consommables
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun consommable trouvé',
            ], 500);
        }
    }

    
    public function update(consommable_request $request, $id)
    {
        $consommable = Consommable::find($id);
        if (!$consommable) {
            return response()->json(['statut' => 404, 'message' => 'Consommable non trouvé'], 404);
        }

        $data = $request->validated();
        $consommable->update($data);

        return response()->json([
            'statut' => 200,
            'consommable' => $consommable
        ]);
    }

    public function destroy($id)
    {
        $consommable = Consommable::find($id);
        if (!$consommable) {
            return response()->json(['statut' => 404, 'message' => 'Consommable non trouvé'], 404);
        }

        $consommable->delete();
        return response()->json(['statut' => 200, 'message' => 'Consommable supprimé avec succès']);
    }

    public function show($id)
    {
        $consommable = Consommable::find($id);
        if (!$consommable) {
            return response()->json(['statut' => 404, 'message' => 'Consommable non trouvé'], 404);
        }

        return response()->json([
            'statut' => 200,
            'consommable' => $consommable
        ]);
    }
}