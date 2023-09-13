<?php

namespace App\Http\Controllers\cours;

use App\Http\Controllers\Controller;
use App\Models\Cour;
use Illuminate\Http\Request;

class cours_controller extends Controller
{
    public function index(){
        $Cour = Cour::all();

        return response()->json($Cour);
        
    }

    public function show($id){
        $Cour = Cour::find($id);

        if (!$Cour) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }
        return response()->json($Cour);
    }

    public function store(Request $request){
        $validatedData = $request->validate([

        'id_cours' => 'required',
        'Intitule_cours' => 'required',
        'heure_debut' => 'required',
        'heure_fin' => 'required',
        'id_classe' => 'required',
        'id_formateur' => 'required',
        'id_matiere' => 'required',
        'id_salle' => 'required',
        'id_semestre' => 'required'

        ]);
        $cour = Cour::create($validatedData);
        return response()->json($cour, 201);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
        'id_cours' => 'required',
        'Intitule_cours' => 'required',
        'heure_debut' => 'required',
        'heure_fin' => 'required',
        'id_classe' => 'required',
        'id_formateur' => 'required',
        'id_matiere' => 'required',
        'id_salle' => 'required',
        'id_semestre' => 'required'
        ]);

        $cour = Cour::find($id);

        if (!$cour) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }
        $cour->update($validatedData);
        return response()->json($cour);


    }

    public function destory($id){
        $cour = Cour::find($id);

        if (!$cour) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }

        $cour->delete();

        return response()->json(['message' => 'Cours supprimé avec succès']);

    }
}
