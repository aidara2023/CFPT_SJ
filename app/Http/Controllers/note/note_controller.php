<?php

namespace App\Http\Controllers\note;

use App\Http\Controllers\Controller;
use App\Models\note;
use Illuminate\Http\Request;


class note_controller extends Controller
{
    public function index(){

        $notes = note::all();
        return response()->json($notes);

    }

    public function show($id){
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['message' => 'Note non trouvée'], 404);
        }
        return response()->json($note);

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'id_eleve'=>'required',
            'id_formateur'=>'required',
            'id_type_evaluation'=>'required',
           'id_annee_academique'=>'required',
            'id_semestre'=>'required',
            'id_matiere'=>'required',
            'Note_obtenue'=>'required',
            'date_enregistrer'=>'required',
            'Appreciation'=>'required',
            'Observation'

        ]);

        $note = Note::create($validatedData);
        return response()->json($note, 201);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
        'id_eleve' => 'required',
        'id_formateur' => 'required',
        'id_type_evaluation' => 'required',
        'id_annee_academique' => 'required',
        'id_semestre' => 'required',
        'id_matiere' => 'required',
        'Note_obtenue' => 'required',
        'date_enregistrer' => 'required',
        'Appreciation' => 'required',
        'Observation' => 'required'
        ]);

        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Note non trouvée'], 404);
        }

        $note->update($validatedData);
        return response()->json($note);

    }

    public function destory($id){
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Note non trouvée'], 404);
        }

        $note->delete();
        return response()->json(['message' => 'Note supprimée avec succès']);

        

    }
}
