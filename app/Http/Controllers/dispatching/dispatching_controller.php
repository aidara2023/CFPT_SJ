<?php

namespace App\Http\Controllers\dispatching;

use App\Http\Controllers\Controller;
use App\Http\Requests\dispatching\dispatching_request;
use App\Models\Dispatching; // Assurez-vous que le modèle Dispatching existe
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;
use App\Models\Batiment;
use App\Models\Salle;
use App\Models\Materiel;
use App\Models\Consommable;
use Illuminate\Http\Request;

class dispatching_controller extends Controller
{
    public function index()
    {
        $dispatchings = Dispatching::orderBy('created_at', 'desc')->get();
        return response()->json([
            'statut' => 200,
            'dispatchings' => $dispatchings,
            'message' => $dispatchings->isEmpty() ? 'Aucune donnée trouvée' : null,
        ]);
    }

    
    

  

    public function getBatiments()
    {
        $batiments = Batiment::all();
        return response()->json([
            'statut' => 200,
            'batiments' => $batiments
        ]);
    }
    public function getSallesByBatiment($batimentId)
{
    try {
        $salles = Salle::where('id_batiment', $batimentId)->get();
        return response()->json([
            'statut' => 200,
            'salles' => $salles
        ]);
    } catch (\Exception $e) {
        // Log l'erreur pour plus de détails
       
        return response()->json([
            'statut' => 500,
            'message' => 'Erreur lors de la récupération des salles'
        ], 500);
    }
}

  

public function dispatchItems(Request $request)
{
    $user = Auth::user();
    $departement = $user->departement;

    try {
        $validatedData = $request->validate([
            'id_commande' => 'required|integer', // Changé de id_demande à id_commande
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.type' => 'required|string',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.id_batiment' => 'required|integer',
            'items.*.id_salle' => 'required|integer',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'statut' => 400,
            'message' => 'Erreur de validation',
            'errors' => $e->validator->errors()
        ], 400);
    }

    foreach ($validatedData['items'] as $item) {
        $salle = Salle::where('id', $item['id_salle'])
                      ->where('id_batiment', $item['id_batiment'])
                      ->first();

        if (!$salle) {
            return response()->json([
                'statut' => 400,
                'message' => 'La salle sélectionnée n\'appartient pas au bâtiment choisi.'
            ], 400);
        }

        Dispatching::create([
            'id_departement' => $departement->id,
            'id_user' => $user->id,
            'id_commande' => $validatedData['id_commande'], // Changé de id_demande à id_commande
            'id_salle' => $item['id_salle'],
            'id_batiment' => $item['id_batiment'],
            $item['type'] === 'materiel' ? 'id_materiel' : 'id_consommable' => $item['id'],
            'quantite' => $item['quantite'],
        ]);
    }
    return response()->json([
        'statut' => 200,
        'message' => 'Dispatching effectué avec succès'
    ]);
}

    public function update(Request $request, $id)
    {
        try {
            $dispatching = Dispatching::findOrFail($id);
            
            // Validation des données
            $validatedData = $request->validate([
                'id_batiment' => 'required|integer|exists:batiments,id',
                'id_salle' => 'required|integer|exists:salles,id',
                'quantite' => 'required|integer|min:1'
            ]);
    
            // Mise à jour du dispatching
            $dispatching->update([
                'id_batiment' => $validatedData['id_batiment'],
                'id_salle' => $validatedData['id_salle'],
                'quantite' => $validatedData['quantite']
            ]);
    
            return response()->json([
                'statut' => 200,
                'message' => 'Dispatching mis à jour avec succès',
                'dispatching' => $dispatching
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la mise à jour du dispatching',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function search(Request $request)
    {
        $dispatching = Dispatching::with(['batiment', 'salle'])
            ->where('id_commande', $request->id_commande) // Changé de id_demande à id_commande
            ->get();

        return response()->json([
            'dispatching' => $dispatching
        ]);
    }


    public function destroy($id)
    {
        $dispatching = Dispatching::find($id);
        if (!$dispatching) {
            return response()->json(['statut' => 404, 'message' => 'Dispatching non trouvé'], 404);
        }

        $dispatching->delete();
        return response()->json(['statut' => 200, 'message' => 'Dispatching supprimé avec succès']);
    }

    public function show($id)
    {
        $dispatching = Dispatching::find($id);
        if (!$dispatching) {
            return response()->json(['statut' => 404, 'message' => 'Dispatching non trouvé'], 404);
        }

        return response()->json([
            'statut' => 200,
            'dispatching' => $dispatching
        ]);
    }
}




