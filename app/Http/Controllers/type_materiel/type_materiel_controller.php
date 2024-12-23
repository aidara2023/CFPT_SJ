<?php

namespace App\Http\Controllers\type_materiel;

use App\Http\Controllers\Controller;
use App\Http\Requests\type_materiel\type_materiel_request;
use App\Models\Type_materiel;
use Illuminate\Http\Request;


class type_materiel_controller extends Controller
{
   

    public function index() {
        $Type_materiel = Type_materiel::orderBy('created_at', 'desc')->get();
        if ($Type_materiel != null) {
            return response()->json([
                'statut' => 200,
                'type_materiel' => $Type_materiel
            ], 200);
        } else {
            return response()->json([ 
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function show($id){
        $Type_materiel = Type_materiel::find($id);

        if (!$Type_materiel) {
            return response()->json(['message' => 'Type de matériel non trouvé'], 404);
        }
    
        return response()->json($Type_materiel);
    }

    public function store(type_materiel_request $request){
        $validatedData = $request->validated();

        $newType_materiel = Type_materiel::create($validatedData);

        return response()->json($newType_materiel, 201);

    }

    
    public function update(type_materiel_request $request, $id){
        $validatedData = $request->validate([
            'intitule' => 'required|string',
            
        ]);

        $type_materiel = Type_materiel::find($id);

        if (!$type_materiel) {
            return response()->json(['message' => 'Type de matériel non trouvé'], 404);
        }

        $type_materiel->update($validatedData);

        return response()->json($type_materiel);
    }

    public function delete($id){
        $type_materiel = Type_materiel::find($id);

        if (!$type_materiel) {
            return response()->json(['message' => 'Type de matériel non trouvé'], 404);
        }

        $type_materiel->delete();

        return response()->json(['message' => 'Type de matériel supprimé avec succès']);
    }

    
}
