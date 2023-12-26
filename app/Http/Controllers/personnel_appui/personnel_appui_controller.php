<?php

namespace App\Http\Controllers\personnel_appui;

use App\Http\Controllers\Controller;
use App\Http\Requests\personnel_appui\personnel_appui_request;
use App\Models\Personnel_appui;
use Illuminate\Http\Request;

class personnel_appui_controller extends Controller
{
    
    public function index()
    {
        $personnel_appuis = Personnel_appui::orderBy('created_at', 'desc')->get();
        if ($personnel_appuis->count() > 0) {
            return response()->json([
                'status' => 200,
                'personnel_appuis' => $personnel_appuis
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(personnel_appui_request $request)
    {
        $data = $request->validated();

        $personnel_appui = Personnel_appui::create($data);
        if ($personnel_appui) {
            return response()->json([
                'status' => 200,
                'personnel_appui' => $personnel_appui
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'enregistrement n\'a pas été effectué',
            ], 500);
        }
    }

    public function update(personnel_appui_request $request, $id)
    {
        $personnel_appui = Personnel_appui::find($id);
        if ($personnel_appui) {
            $data = $request->validate([
                'intitule' => 'required',
                
            ]);

            $personnel_appui->update($data);

            return response()->json([
                'status' => 200,
                'personnel_appui' => $personnel_appui
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
        $personnel_appui = Personnel_appui::find($id);
        if ($personnel_appui) {
            $personnel_appui->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Personnel_appui supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le personnel_appui n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $personnel_appui = Personnel_appui::find($id);
        if ($personnel_appui) {
            return response()->json([
                'status' => 200,
                'personnel_appui' => $personnel_appui
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le personnel_appui n\'existe pas',
            ], 500);
        }
    }
}
