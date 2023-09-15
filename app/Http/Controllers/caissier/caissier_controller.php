<?php

namespace App\Http\Controllers\caissier;


use App\Http\Controllers\Controller;
use App\Http\Requests\caissier\caissier_request;
use App\Models\Caissier;
use App\Models\User;
use Illuminate\Http\Request;



class caissier_controller extends Controller
{
    public function index(){

        $data = Caissier::all();
        return response()->json($data);
    }

    public function show($id){
        $caissier = Caissier::find($id);

        if (!$caissier) {
            return response()->json(['message' => 'Caissier non trouvé'], 404);
        }

        return response()->json($caissier);

    }
    public function store(caissier_request $request){
        $validatedData = $request->validated();

        $user=User::create($validatedData);
        $caissier=Caissier::create([
            'id_service'=>$request['id_service'],
            'id_user'=>$user->id
        ]);

        $caissier = Caissier::find($validatedData);

        if (!$caissier) {
            return response()->json(['message' => 'Caissier non trouvé'], 404);
        }

        $caissier->update($validatedData);

        return response()->json($caissier);
        
    }

    public function update(caissier_request $request, $id){
        $validatedData = $request->validate([
        'Nom' => 'required',
        'Prénom' => 'required',
        'Genre' => 'required',
        'Adresse' => 'required',
        'Email' => 'required',
        'Telephone' => 'required',
        'Mdp' => 'required',
        'date_naissance' => 'required',
        'Lieu_naissance' => 'required',
        'Nationalité' => 'required',
        'Photo' => 'required',
        'id_role' => 'required',
        'id_service' => 'required'
        ]);

        $caissier = Caissier::find($id);

        if (!$caissier) {
            return response()->json(['message' => 'Caissier non trouvé'], 404);
        }

        $caissier->update($validatedData);
        $user = $caissier->user;
        $user->update($validatedData);
        return response()->json($caissier);

    }

    public function destroy($id){
        $caissier = Caissier::find($id);

        if (!$caissier) {
            return response()->json(['message' => 'Caissier non trouvé'], 404);
        }

        $caissier->delete();

        return response()->json(['message' => 'Caissier supprimé avec succès']);


    }
}
