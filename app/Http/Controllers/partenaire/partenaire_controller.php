<?php

namespace App\Http\Controllers\partenaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\partenaire\partenaire_request;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class partenaire_controller extends Controller
{
       public function index()
        {
            $partenaires = Partenaire::orderBy('created_at', 'desc')->get();
            if ($partenaires->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'partenaires' => $partenaires
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Aucune donnée trouvée',
                ], 500);
            }
        }
    
        public function store(partenaire_request $request)
        {
            $data = $request->validated();
    
            $partenaire = Partenaire::create($data);
            if ($partenaire) {
                return response()->json([
                    'status' => 200,
                    'partenaire' => $partenaire
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'L\'enregistrement n\'a pas été effectué',
                ], 500);
            }
        }
    
        public function update(partenaire_request $request, $id)
        {
            $partenaire = Partenaire::find($id);
            if ($partenaire) {
                $data = $request->validate([
                    'nom_partenaire' => 'required',
                    'type' => 'required',
                    'description' => 'required',
                    'contact' => 'required',
                    'email' => 'required|email',
                    'adresse' => 'required',
                    'boite_postale' => 'required',
                    'date_debut' => 'required',
                    'date_fin' => 'required',
                    'id_direction' => 'required'
                ]);
    
                $partenaire->update($data);
    
                return response()->json([
                    'status' => 200,
                    'partenaire' => $partenaire
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
            $partenaire = Partenaire::find($id);
            if ($partenaire) {
                $partenaire->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Partenaire supprimé avec succès',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le partenaire n\'a pas été supprimé',
                ], 500);
            }
        }
    
        public function show($id)
        {
            $partenaire = Partenaire::find($id);
            if ($partenaire) {
                return response()->json([
                    'status' => 200,
                    'partenaire' => $partenaire
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le partenaire n\'existe pas',
                ], 500);
            }
        }
    }
    