<?php

namespace App\Http\Controllers\consommable;

use App\Http\Controllers\Controller;
use App\Http\Requests\consommable\consommable_request;
use App\Models\Consommable;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class consommable_controller extends Controller
{
    public function index()
    {
        try {
            $consommables = Consommable::with(['etat', 'departement', 'commande'])
                ->orderBy('created_at', 'desc')
                ->paginate(10); // Ajouter la pagination avec 10 éléments par page
                
            return response()->json([
                'statut' => 200,
                'consommables' => $consommables
            ], 200);
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
            
            // Définir la source par défaut à 'stock'
            $data['source'] = 'stock';
            
            // Si la requête contient id_commande, la source devient 'commande'
            if (isset($data['id_commande'])) {
                // Vérifier si la commande existe
                $commande = Commande::find($data['id_commande']);
                if (!$commande) {
                    return response()->json([
                        'statut' => 404,
                        'message' => 'La commande spécifiée n\'existe pas.',
                    ], 404);
                }
                $data['source'] = 'commande';
            }

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
        try {
            $query = Consommable::with(['etat', 'departement', 'commande']);

            // Appliquer la recherche si un terme est fourni
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('libelle', 'like', "%{$searchTerm}%")
                      ->orWhere('marque', 'like', "%{$searchTerm}%");
                });
            }

            // Trier par date de création décroissante
            $query->orderBy('created_at', 'desc');

            // Paginer les résultats
            $perPage = $request->input('per_page', 10);
            $consommables = $query->paginate($perPage);

            return response()->json([
                'statut' => 200,
                'consommables' => $consommables
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche des consommables: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de la recherche des consommables.',
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