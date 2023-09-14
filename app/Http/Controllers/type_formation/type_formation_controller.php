<?php

namespace App\Http\Controllers\type_formation;

use App\Http\Controllers\Controller;
use App\Models\Type_formation;
use Illuminate\Http\Request;

class type_formation_controller extends Controller
{

    public function index()
    {
        $Type_Formations = Type_formation::all();
        if ($Type_Formations->count() > 0) {
            return response()->json([
                'status' => 200,
                'Type_Formations' => $Type_Formations
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'aucun donner trouver',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'intitule' => 'required',
        ]);

        $Type_Formation = Type_Formation::create($data);
        if ($Type_Formation) {
            return response()->json([
                'status' => 200,
                'Type_Formation' => $Type_Formation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'enregistrement n\'a pas été effectué',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $Type_Formation = Type_Formation::find($id);
        if ($Type_Formation) {
            $data = $request->validate([
                'nom_type' => 'required',
            ]);

            $Type_Formation->update($data);

            return response()->json([
                'status' => 200,
                'Type_Formation' => $Type_Formation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'La mise à jour n\'a pas été effectuée',
            ], 500);
        }
    }

    public function destroy($id)
    {
        $Type_Formation = Type_Formation::find($id);
        if ($Type_Formation) {
            $Type_Formation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Type de formation supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le type de formation n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $Type_Formation = Type_Formation::find($id);
        if ($Type_Formation) {
            return response()->json([
                'status' => 200,
                'Type_Formation' => $Type_Formation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le type de formation n\'existe pas',
            ], 500);
        }
    }
  
}
