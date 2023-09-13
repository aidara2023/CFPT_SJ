<?php

namespace App\Http\Controllers\consultation;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class consultation_controller extends Controller
{
    public function index()
    {
       
        $consultations = Consultation::all();

        
        return response()->json($consultations);
    }

    public function show($id)
    {
        
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json(['message' => 'Consultation non trouvée'], 404);
        }

        
        return response()->json($consultation);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'id_consultation' => 'required',
            'id_user' => 'required',
            'id_infirmier' => 'required',
            'id_dossier_medical' => 'required',
            
        ]);

        
        $consultation = Consultation::create($validatedData);

        
        return response()->json($consultation, 201);
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'id_consultation' => 'required',
            'id_user' => 'required',
            'id_infirmier' => 'required',
            'id_dossier_medical' => 'required',
           
        ]);

        
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json(['message' => 'Consultation non trouvée'], 404);
        }

        
        $consultation->update($validatedData);

        
        return response()->json($consultation);
    }

    public function destroy($id)
    {
        
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json(['message' => 'Consultation non trouvée'], 404);
        }

        
        $consultation->delete();

        
        return response()->json(['message' => 'Consultation supprimée avec succès']);
    }

}
