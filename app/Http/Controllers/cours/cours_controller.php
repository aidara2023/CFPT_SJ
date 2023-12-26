<?php

namespace App\Http\Controllers\cours;

use App\Http\Controllers\Controller;
use App\Http\Requests\cours\cours_request;
use App\Models\Cour;
use Illuminate\Http\Request;

class cours_controller extends Controller
{
    public function index(){
        $Cour = Cour::orderBy('created_at', 'desc')->get();

        return response()->json($Cour);
        
    }

    public function show($id){
        $Cour = Cour::find($id);

        if (!$Cour) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }
        return response()->json($Cour);
    }

    public function store(cours_request $request){
        $validatedData = $request->validated();
        $cour = Cour::create($validatedData);
        return response()->json($cour, 200);
    }

    public function update(cours_request $request, $id){
        $validatedData = $request->validated();

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
