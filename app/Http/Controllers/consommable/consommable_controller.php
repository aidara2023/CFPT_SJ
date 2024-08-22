<?php

namespace App\Http\Controllers\consommable;

use App\Http\Controllers\Controller;
use App\Http\Requests\consommable\consommable_request;
use App\Models\Consommable; // Assurez-vous que le modèle Consommable existe
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class consommable_controller extends Controller
{
    public function index()
    {
        Log::info('Récupération des consommables');
        $consommables = Consommable::all();
        Log::info('Consommables récupérés:', ['consommables' => $consommables]);
        return response()->json(['consommables' => $consommables]);
    }
    
   

    public function store(consommable_request $request)
    {
        $data = $request->validated();
        $consommable = Consommable::create($data);
        return response()->json([
            'statut' => $consommable ? 200 : 500,
            'consommable' => $consommable,
            'message' => $consommable ? null : 'L\'enregistrement n\'a pas été effectué',
            
        ]);
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