<?php

namespace App\Http\Controllers\seminaire;

use App\Http\Controllers\Controller;
use App\Models\Seminaire;
use Illuminate\Http\Request;

class seminaire_controller extends Controller
{

        public function index()
        {
            $seminaires = Seminaire::all();
            if ($seminaires->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'seminaires' => $seminaires
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
                'titre' => 'required',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'description' => 'required',
                'id_direction' => 'required',
            ]);
    
            $seminaire = Seminaire::create($data);
            if ($seminaire) {
                return response()->json([
                    'status' => 200,
                    'seminaire' => $seminaire
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
            $seminaire = Seminaire::find($id);
            if ($seminaire) {
                $data = $request->validate([
                    'titre' => 'required',
                    'date_debut' => 'required',
                    'date_fin' => 'required',
                    'description' => 'required',
                    'id_direction' => 'required',
                ]);
    
                $seminaire->update($data);
    
                return response()->json([
                    'status' => 200,
                    'seminaire' => $seminaire
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
            $seminaire = Seminaire::find($id);
            if ($seminaire) {
                $seminaire->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Séminaire supprimé avec succès',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le séminaire n\'a pas été supprimé',
                ], 500);
            }
        }
    
        public function show($id)
        {
            $seminaire = Seminaire::find($id);
            if ($seminaire) {
                return response()->json([
                    'status' => 200,
                    'seminaire' => $seminaire
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le séminaire n\'existe pas',
                ], 500);
            }
        }
    }
    