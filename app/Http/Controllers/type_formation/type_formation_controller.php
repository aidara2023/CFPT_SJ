<?php

namespace App\Http\Controllers\type_formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\typr_formation\type_formation_request;
use App\Models\Type_formation;
use Illuminate\Http\Request;

class type_formation_controller extends Controller
{

    public function index()
    {
        $type_Formations = Type_formation::all();
        if ($type_Formations->count() > 0) {
            return response()->json([
                'status' => 200,
                'Type_Formations' => $type_Formations
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucun donné trouvé',
            ], 500);
        }
    }

    public function store(type_formation_request $request)
    {
        $data = $request->validated();

        $Type_Formation = Type_formation::create($data);
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

    public function update(type_formation_request $request, $id)
    {
        $Type_Formation = Type_formation::find($id);
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

    public function delete($id)
    {
        $Type_Formation = Type_formation::find($id);
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
        $Type_Formation = Type_formation::find($id);
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
