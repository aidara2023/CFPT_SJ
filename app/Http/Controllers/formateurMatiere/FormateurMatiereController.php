<?php

namespace App\Http\Controllers\formateurMatiere;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Http\Controllers\Controller;
use App\Models\FormateurMatiere;
use Illuminate\Http\Request;

class FormateurMatiereController extends Controller
{
    public function index() {
        $matiere_formateur = FormateurMatiere::with('matiere', 'formateur.user')->orderBy('created_at', 'desc')->get();
        if ($matiere_formateur != null) {
            return response()->json([
                'statut' => 200,
                'matiereFormateur' => $matiere_formateur,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }
public function all_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $matiere_formateur = FormateurMatiere::with('matiere', 'formateur.user')->orderBy('created_at', 'desc')->paginate($perPage);
        if ($matiere_formateur != null) {
            return response()->json([
                'statut' => 200,
                'matiereFormateur' => $matiere_formateur,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }
   /*  public function store_matiere_professeur(Request $request){
         $matiereProfesseurs = json_decode($request->input('matiereProfessur'), true);
     
         foreach ($matiereProfesseurs as $matiere) {
        
             $matiere = [
                 'id_matiere' => $matiere['id_matiere'],
                 'id_formateur' => $request['id_formateur'],
             ];
     
             $matiereprofesseur = FormateurMatiere::create($matiere);
             event(new ModelCreated($matiereprofesseur));
         }
     
         if(isset($matiereprofesseur)){
             return response()->json([
                 'statut'=>200,
                 'role'=>$matiereprofesseur
             ],200);
         } else {
             return response()->json([
                 'statut'=>500,
                 'message'=>'L\'enregistrement n\'a pas été effectué',
             ],500);
         }
     }  */

     public function store_matiere_professeur(Request $request){
    $matiereProfesseurs = json_decode($request->input('matiereProfessur'), true);
    $id_formateur = $request['id_formateur'];
    if(isset($id_formateur)){
        foreach ($matiereProfesseurs as $matiere) {
            // Check if the subject is already assigned to the instructor
            $existingAssignment = FormateurMatiere::with('matiere')
            ->where('id_matiere', $matiere['id_matiere'])
            ->where('id_formateur', $id_formateur)  
            ->first();
            
            if ($existingAssignment) {
                $matiereName = $existingAssignment->matiere->intitule; // Assuming 'nom' is the field name for the subject name
                $formateurName = $existingAssignment->formateur->user->nom; // Assuming 'nom' is the field name for the subject name
    
                return response()->json([
                    'statut' => 409, // Conflict status code
                    'message' => 'La matière "' . $matiereName . '" est déjà assignée au formateur ' . $formateurName,
                ], 409);
            }
    
            $matiereData = [
                'id_matiere' => $matiere['id_matiere'],
                'id_formateur' => $id_formateur,
            ];
    
            $matiereprofesseur = FormateurMatiere::create($matiereData);
            event(new ModelCreated($matiereprofesseur));
        }
    }else{
        foreach ($matiereProfesseurs as $matiere) {
            // Check if the subject is already assigned to the instructor
            $existingAssignment = FormateurMatiere::with('matiere')
            ->where('id_matiere', $matiere['id_matiere'])
            ->where('id_formateur', $matiere['id_formateur'])  
            ->first();
            
            if ($existingAssignment) {
                $matiereName = $existingAssignment->matiere->intitule; // Assuming 'nom' is the field name for the subject name
                $formateurName = $existingAssignment->formateur->user->nom; // Assuming 'nom' is the field name for the subject name
    
                return response()->json([
                    'statut' => 409, // Conflict status code
                    'message' => 'La matière "' . $matiereName . '" est déjà assignée au formateur ' . $formateurName,
                ], 409);
            }
    
            $matiereData = [
                'id_matiere' => $matiere['id_matiere'],
                'id_formateur' => $matiere['id_formateur'],
            ];
    
            $matiereprofesseur = FormateurMatiere::create($matiereData);
            event(new ModelCreated($matiereprofesseur));
        }
    }

 

    if (isset($matiereprofesseur)) {
        return response()->json([
            'statut' => 200,
            'role' => $matiereprofesseur
        ], 200);
    } else {
        return response()->json([
            'statut' => 500,
            'message' => 'L\'enregistrement n\'a pas été effectué',
        ], 500);
    }
}

public function delete($id){
    $matiereFormateur=FormateurMatiere::find($id);
    if($matiereFormateur!=null){
        $matiereFormateur->delete();
        event(new ModelDeleted($matiereFormateur));
        return response()->json([
            'statut'=>200,
            'message'=>'La matiére a été supprimée avec succes',
        ],200)  ;
    }else{
        return response()->json([ 
            'statut'=>500,
            'message'=>'Echec suppression de la matiére',
        ],500 );
    }
   
}

}
