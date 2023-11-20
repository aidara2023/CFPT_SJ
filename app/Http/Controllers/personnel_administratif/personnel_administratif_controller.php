<?php

namespace App\Http\Controllers\personnel_administratif;

use App\Http\Controllers\Controller;
use App\Http\Requests\personnel_administratif\personnel_administratif_request;
use App\Models\Personnel_administratif;
use Illuminate\Http\Request;

class personnel_administratif_controller extends Controller
{
    public function index()
    {
        $personnel_administratifs = Personnel_administratif::all();
        if ($personnel_administratifs->count() > 0) {
            return response()->json([
                'status' => 200,
                'personnel_administratifs' => $personnel_administratifs
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(personnel_administratif_request $request)
    {
        $data = $request->validated();

        $personnel_administratif = Personnel_administratif::create($data);
        if ($personnel_administratif) {
            return response()->json([
                'status' => 200,
                'personnel_administratif' => $personnel_administratif
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'L\'enregistrement n\'a pas été effectué',
            ], 500);
        }
    }

    public function update(personnel_administratif_request $request, $id)
    {
        $personnel_administratif = Personnel_administratif::find($id);
        if ($personnel_administratif) {
            $data = $request->validate([
                'intitule' => 'required',
                
            ]);

            $personnel_administratif->update($data);

            return response()->json([
                'status' => 200,
                'personnel_administratif' => $personnel_administratif
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
        $personnel_administratif = Personnel_administratif::find($id);
        if ($personnel_administratif) {
            $personnel_administratif->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Personnel_administratif supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le personnel_administratif n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $personnel_administratif = Personnel_administratif::find($id);
        if ($personnel_administratif) {
            return response()->json([
                'status' => 200,
                'personnel_administratif' => $personnel_administratif
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le personnel_administratif n\'existe pas',
            ], 500);
        }
    }
}
