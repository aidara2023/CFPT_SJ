<?php

namespace App\Http\Controllers\eleve;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use Illuminate\Http\Request;

class eleve_controller extends Controller
{
        //
    public function index()
    {
        $eleves = Eleve::all();
        return view('eleves.index', ['eleves' => $eleves]);
    }
    public function show($id)
    {
        $eleve = Eleve::find($id);
        return view('eleves.show', ['eleve' => $eleve]);
    }



    public function create()
    {
        return view('eleves.create');
    }
    
    public function store(Request $request)
    {
        // Validez les données du formulaire ici
    
        Eleve::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            // Ajoutez d'autres attributs ici
        ]);
    
        return redirect()->route('eleves.index')->with('success', 'Élève ajouté avec succès');
    }



    public function edit($id)
    {
        $eleve = Eleve::find($id);
        return view('eleves.edit', ['eleve' => $eleve]);
    }

    public function update(Request $request, $id)
    {
        // Validez les données du formulaire ici

        $eleve = Eleve::find($id);
        $eleve->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            // Mettez à jour d'autres attributs ici
        ]);

        return redirect()->route('eleves.index')->with('success', 'Élève mis à jour avec succès');
    }

    public function destroy($id)
    {
        $eleve = Eleve::find($id);
        $eleve->delete();
        return redirect()->route('eleves.index')->with('success', 'Élève supprimé avec succès');
    }

}
