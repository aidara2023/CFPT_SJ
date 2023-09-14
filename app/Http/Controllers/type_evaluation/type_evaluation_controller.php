<?php

namespace App\Http\Controllers\type_evaluation;

use App\Http\Controllers\Controller;
use App\Models\Type_evaluation;
use Illuminate\Http\Request;

class type_evaluation_controller extends Controller
{
    public function index()
    {
        $type_Evaluations = Type_evaluation::all();
        if ($type_Evaluations->count() > 0) {
            return response()->json([
                'status' => 200,
                'type_Evaluations' => $type_Evaluations
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
            'libelle' => 'required',
        ]);

        $type_Evaluation = Type_Evaluation::create($data);
        if ($type_Evaluation) {
            return response()->json([
                'status' => 200,
                'type_Evaluation' => $type_Evaluation
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
        $type_Evaluation = Type_Evaluation::find($id);
        if ($type_Evaluation) {
            $data = $request->validate([
                'libeller' => 'required',
            ]);

            $type_Evaluation->update($data);

            return response()->json([
                'status' => 200,
                'type_Evaluation' => $type_Evaluation
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
        $type_Evaluation = Type_Evaluation::find($id);
        if ($type_Evaluation) {
            $type_Evaluation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Type d\'évaluation supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le type d\'évaluation n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $type_Evaluation = Type_Evaluation::find($id);
        if ($type_Evaluation) {
            return response()->json([
                'status' => 200,
                'type_Evaluation' => $type_Evaluation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le type d\'évaluation n\'existe pas',
            ], 500);
        }
    }
}
