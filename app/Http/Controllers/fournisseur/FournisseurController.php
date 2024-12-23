<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fournisseur\FournisseurRequest;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index() {
        $fournisseurs = Fournisseur::with('secteurActivite')  // Ajout de with()
            ->orderBy('created_at', 'desc')
            ->get();
            
        if ($fournisseurs != null) {
            return response()->json([
                'statut' => 200,
                'fournisseurs' => $fournisseurs
            ], 200);
        } else {
            return response()->json([ 
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }
    public function show($id) {
        $fournisseur = Fournisseur::find($id);

        if (!$fournisseur) {
            return response()->json(['message' => 'Fournisseur non trouvé'], 404);
        }

        return response()->json($fournisseur);
    }

    public function store(FournisseurRequest $request) {
        $validatedData = $request->validated();

        $newFournisseur = Fournisseur::create($validatedData);

        return response()->json($newFournisseur, 201);
    }

    public function update(FournisseurRequest $request, $id) {
        $validatedData = $request->validated();

        $fournisseur = Fournisseur::find($id);

        if (!$fournisseur) {
            return response()->json(['message' => 'Fournisseur non trouvé'], 404);
        }

        $fournisseur->update($validatedData);

        return response()->json($fournisseur);
    }

    public function delete($id) {
        $fournisseur = Fournisseur::find($id);

        if (!$fournisseur) {
            return response()->json(['message' => 'Fournisseur non trouvé'], 404);
        }

        $fournisseur->delete();

        return response()->json(['message' => 'Fournisseur supprimé avec succès']);
    }
}