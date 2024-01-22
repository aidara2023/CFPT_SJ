<?php

namespace App\Http\Controllers\batiment;

use App\Http\Controllers\Controller;
use App\Http\Requests\batiment\batiment_request;
use App\Models\Batiment;
use Illuminate\Http\Request;

class batiment_controller extends Controller
{
    public function index()
    {
        $batiment = Batiment::with('salle')->get(); /* ->orderBy('created_at', 'desc') */
        if ($batiment != null) {
            return response()->json([
                'statut' => 200,
                'batiment' => $batiment
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function store(batiment_request $request)
    {
        try {
            // Validation des données
            $data = $request->validated();
    
            // Vérification si le batiment existe déjà
            $existingBatiment = Batiment::where('intitule', $data['intitule'])->first();
    
            if ($existingBatiment) {
                return response()->json([
                    'statut' => 404,
                    'message' => 'Ce batiment existe déjà.',
                ], 404);
            }
    
            // Création du batiment
            $batiment = Batiment::create($data);
    
            if ($batiment) {
                return Response()->json([
                    'statut' => 200,
                    'batiment' => $batiment,
                ], 200);
            } else {
                return Response()->json([
                    'statut' => 500,
                    'message' => 'L\'enregistrement n\'a pas été effectué.',
                ], 500);
            }
        } catch (\Exception $e) {
            // Gérer les erreurs exceptionnelles ici
            return Response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de l\'enregistrement.',
            ], 500);
        }
    }
    public function update(batiment_request $request, $id)
    {
        try {
            $batiment = Batiment::find($id);
    
            if ($batiment != null) {
                // Vérification si le batiment existe déjà avec un autre enregistrement
                $existingBatiment = Batiment::where('intitule', $request->input('intitule'))
                    ->where('id', '!=', $id)
                    ->first();
    
                if ($existingBatiment) {
                    return Response()->json([
                        'statut' => 404,
                        'message' => 'Ce batiment existe déjà.',
                    ], 404);
                }
    
                // Mise à jour du batiment
                $batiment->update([
                    'intitule' => $request->input('intitule'),
                    // Ajoutez d'autres champs à mettre à jour ici
                ]);
    
                return Response()->json([
                    'statut' => 200,
                    'batiment' => $batiment,
                ], 200);
            } else {
                return Response()->json([
                    'statut' => 500,
                    'message' => 'La mise à jour n\'a pas été effectuée.',
                ], 500);
            }
        } catch (\Exception $e) {
            // Gérer les erreurs exceptionnelles ici
            return Response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de la mise à jour.',
            ], 500);
        }
        
    }

    public function delete($id)
    {
        $batiment = Batiment::find($id);
        if ($batiment != null) {
            $batiment->delete();
            return response()->json([
                'statut' => 200,
                'message' => 'Le batiment est supprimé avec succes',
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Le batiment n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $batiment = Batiment::find($id);
        if ($batiment != null) {
            return response()->json([
                'statut' => 200,
                'batiment' => $batiment
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'batiment n\'a pas été trouvé',
            ], 500);
        }
    }
}
