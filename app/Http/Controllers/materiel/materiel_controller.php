<?php

namespace App\Http\Controllers\materiel;

use App\Http\Controllers\Controller;
use App\Http\Requests\materiel\materiel_request;
use App\Models\Materiel;
use Illuminate\Http\Request;

class materiel_controller extends Controller
{
        public function index()
        {
            $materiels = Materiel::orderBy('created_at', 'desc')->get();
            if ($materiels->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'materiels' => $materiels
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Aucune donnée trouvée',
                ], 500);
            }
        }
    
        public function store(materiel_request $request)
        {
            $data = $request->validated();
    
            $materiel = Materiel::create($data);
            if ($materiel) {
                return response()->json([
                    'status' => 200,
                    'materiel' => $materiel
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'L\'enregistrement n\'a pas été effectué',
                ], 500);
            }
        }
    
        public function update(materiel_request $request, $id)
        {
            $materiel = Materiel::find($id);
            if ($materiel) {
                $data = $request->validate([
                    'Nom' => 'required',
                    'date_entree' => 'required',
                    'date_sortie' => 'required',
                    'Etat' => 'required',
                    'Quantité' => 'required',
                    'id_service' => 'required',
                    'id_salle' => 'required',
                    'id_type_materiel' => 'required',
                    'id_statut' => 'required',
                    'id_unite_formation' => 'required',
                ]);
    
                $materiel->update($data);
    
                return response()->json([
                    'status' => 200,
                    'materiel' => $materiel
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
            $materiel = Materiel::find($id);
            if ($materiel) {
                $materiel->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Matériel supprimé avec succès',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le matériel n\'a pas été supprimé',
                ], 500);
            }
        }
    
        public function show($id)
        {
            $materiel = Materiel::find($id);
            if ($materiel) {
                return response()->json([
                    'status' => 200,
                    'materiel' => $materiel
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le matériel n\'existe pas',
                ], 500);
            }
        }
    }
    