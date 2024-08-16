<?php

namespace App\Http\Controllers\dispatching;

use App\Http\Controllers\Controller;
use App\Http\Requests\dispatching\dispatching_request;
use App\Models\Dispatching; // Assurez-vous que le modèle Dispatching existe
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

    public function store(dispatching_request $request)
    {
        $data = $request->validated();
        $dispatching = Dispatching::create($data);
        return response()->json([
            'statut' => $dispatching ? 200 : 500,
            'dispatching' => $dispatching,
            'message' => $dispatching ? null : 'L\'enregistrement n\'a pas été effectué',
        ]);
    }

    public function update(dispatching_request $request, $id)
    {
        $dispatching = Dispatching::find($id);
        if (!$dispatching) {
            return response()->json(['statut' => 404, 'message' => 'Dispatching non trouvé'], 404);
        }

        $data = $request->validated();
        $dispatching->update($data);

        return response()->json([
            'statut' => 200,
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