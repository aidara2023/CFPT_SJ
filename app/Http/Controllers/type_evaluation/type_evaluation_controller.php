<?php

namespace App\Http\Controllers\type_evaluation;

use App\Http\Controllers\Controller;
use App\Http\Requests\type_evaluation\type_evaluation_request;
use App\Models\Type_evaluation;
use Illuminate\Http\Request;

class type_evaluation_controller extends Controller
{
    public function index()
    {
        $type_Evaluation = Type_evaluation::orderBy('created_at', 'desc')->get();
        if ($type_Evaluation->count() > 0) {
            return response()->json([
                'status' => 200,
                'type_Evaluation' => $type_Evaluation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(type_evaluation_request $request)
    {
        $data = $request->validated();

        $type_Evaluation = Type_evaluation::create($data);
        if ($type_Evaluation) {
            return response()->json([
                'status' => 200,
                'type_Evaluation' => $type_Evaluation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'enregistrement n\'a pas été ajouté',
            ], 500);
        }
    }

    public function update(type_evaluation_request $request, $id)
    {
        $type_Evaluation = Type_evaluation::find($id);
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

    public function delete($id)
    {
        $type_Evaluation = Type_evaluation::find($id);
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
        $type_Evaluation = Type_evaluation::find($id);
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
