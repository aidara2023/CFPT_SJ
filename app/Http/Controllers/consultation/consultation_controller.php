<?php

namespace App\Http\Controllers\consultation;

use App\Http\Controllers\Controller;
use App\Http\Requests\consultation\consultation_request;
use App\Models\Consultation;
use Illuminate\Http\Request;

class consultation_controller extends Controller
{
    public function index()
    {
       
        $consultations = Consultation::orderBy('created_at', 'desc')->get();

        
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

    public function store(consultation_request $request)
    {
        
        $validatedData = $request->validated();

        
        $consultation = Consultation::create($validatedData);

        
        return response()->json($consultation, 200);
    }

    public function update(consultation_request $request, $id)
    {
        
        $validatedData = $request->validated();

        
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json(['message' => 'Consultation non trouvée'], 404);
        }

        
        $consultation->update($validatedData);

        
        return response()->json($consultation);
    }

    public function delete($id)
    {
        
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json(['message' => 'Consultation non trouvée'], 404);
        }

        
        $consultation->delete();

        
        return response()->json(['message' => 'Consultation supprimée avec succès']);
    }

}
