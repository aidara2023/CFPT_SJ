<?php

namespace App\Http\Controllers\formateur;

use App\Http\Controllers\Controller;
use App\Http\Requests\formateur\formateur_request;
use App\Models\Formateur;
use App\Models\FormateurMatiere;
use App\Models\Unite_de_formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class formateur_controller extends Controller
{
    public function index() {
        $formateur=Formateur::with('user')->orderBy('created_at', 'desc')->get();
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

    public function store (formateur_request $request){
        $data=$request->validated();
        $user=User::create($data);
        $formateur=Formateur::create([
            'type'=>$request->type,
            'situation_matrimoniale'=>$request->situation_matrimoniale,
            'id_specialite'=>$request->id_specialite,
            'id_unite_de_formation'=>$request->id_unite_de_formation,
            'id_user'=>$user->id
        ]);
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function getClassesByFormateur()
    {
        $formateur = Formateur::where('id_user', Auth::id())->first();

        if ($formateur) {
            // Récupère les cours du formateur
            $cours = $formateur->cour;

            // Récupère les classes associées à ces cours
            $classes = $cours->map(function($cour) {
                return $cour->classe;
            })->unique('id'); // Utilisation de unique pour éviter les doublons

            return response()->json($classes);
        } else {
            return response()->json(['message' => 'Formateur non trouvé'], 404);
        } 
    }
    
    public function update(formateur_request $request, $id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
           $formateur->type=$request['type'];
           $formateur->situation_matrimoniale=$request['situation_matrimoniale'];
           $formateur->id_specialite=$request['id_specialite'];
           $formateur->id_unite_de_formation=$request['id_unite_de_formation'];
           $formateur->id_user=$request['id_user'];

           $formateur->save();
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
            $formateur->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Formateur supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Le formateur n\'est pas supprimer',
            ],500 );
        }

    }

    public function show($id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Le formateur n\'existe pas',
            ],500 );
        }

    }
    public function find_professeur($id){
        $formateur=Formateur::where('id_user', $id)->first();
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Le formateur n\'existe pas',
            ],500 );
        }

    }

    public function get_formateur_by_id_uniteformation($id){
        // Rechercher toutes les unités de formation associées au département
        $unite_de_formation = Unite_de_formation::where('id_departement', $id)->get();
    
        if ($unite_de_formation->isEmpty()) {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune unité de formation trouvée pour ce département',
            ], 500);
        }
    
        // Accumuler tous les formateurs associés aux unités de formation
        $formateurs = [];
        foreach ($unite_de_formation as $unite) {
            $formateurs_unite = Formateur::with('user')->where('id_unite_de_formation', $unite->id)->get();
            $formateurs = array_merge($formateurs, $formateurs_unite->toArray());
        }
    
        if (!empty($formateurs)) {
            return response()->json([
                'statut' => 200,
                'formateur' => $formateurs
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun formateur trouvé pour ce département',
            ], 500);
        }
    }
    

    public function find_matiere_professeur($id){
        $matiereformateur=FormateurMatiere::with('matiere')->where('id_formateur', $id)->get();
        if($matiereformateur!=null){
            return response()->json([
                'statut'=>200,
                'matiereformateur'=>$matiereformateur
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune matiere n\'à été assigné a ce professeur',
            ],500 );
        }

    }
   
    
    public function getClassesByFormateurs()
    {
        // Récupérer le formateur connecté
        $formateur = Formateur::where('id_user', Auth::id())->first();
    
        if ($formateur) {
            // Récupérer les cours associés au formateur
            $cours = $formateur->cour;
    
            // Récupérer les classes associées aux cours du formateur
            $classes = $cours->map(function($cour) {
                return $cour->Classe; // Ensure 'Classe' matches your relationship method
            })->unique('id'); // Utilisation de unique pour éviter les doublons
    
            return response()->json([
                'status' => 200,
                'classes' => $classes
            ]);
        } else {
            return response()->json(['message' => 'Formateur non trouvé'], 404);
        }
    }
    
    
    
    
    
    


}
