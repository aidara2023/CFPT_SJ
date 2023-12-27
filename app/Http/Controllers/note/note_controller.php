<?php

namespace App\Http\Controllers\note;

use App\Http\Controllers\Controller;
use App\Http\Requests\note\note_request;
use App\Models\note;
use Illuminate\Http\Request;


class note_controller extends Controller
{
    public function index(){

        $notes = note::orderBy('created_at', 'desc')->get();
        return response()->json($notes);

    }

    public function show($id){
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['message' => 'Note non trouvée'], 404);
        }
        return response()->json($note);

    }

    public function store(note_request $request){
        $validatedData = $request->validated();

        $note = Note::create($validatedData);
        return response()->json($note, 201);
    }

    public function update(note_request $request, $id){
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

    public function delete($id){
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Note non trouvée'], 404);
        }

        $note->delete();
        return response()->json(['message' => 'Note supprimée avec succès']);

        

    }
}
