<?php

namespace App\Http\Controllers\emprunter_livre;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Emprunter_livre;
use App\Models\Livre;
use Illuminate\Http\Request;

class emprunter_livre_controller extends Controller
{
    //
    public function index()
    {
        $emprunts = Emprunter_livre::all();
        return view('emprunter_livre.index', ['emprunts' => $emprunts]);
    }

    public function create()
    {
        // Affichez un formulaire pour permettre à l'utilisateur de sélectionner l'élève et le livre à emprunter
        $eleves = Eleve::all();
        $livres = Livre::where('disponible', true)->get();

        return view('emprunter_livre.create', ['eleves' => $eleves, 'livres' => $livres]);
    }

    public function store(Request $request)
    {
        // Validez les données du formulaire ici

        Emprunter_livre::create([
            'eleve_id' => $request->input('eleve_id'),
            'livre_id' => $request->input('livre_id'),
            'date_emprunter' => now(),
        ]);

        // Mettez à jour le statut de disponibilité du livre
        $livre = Livre::find($request->input('livre_id'));
        $livre->disponible = false;
        $livre->save();

        return redirect()->route('emprunts.index')->with('success', 'Livre emprunté avec succès');
    }
    public function rendre(Request $request, $id)
    {
        $emprunt = Emprunter_livre::find($id);

        if (!$emprunt) {
            return redirect()->back()->with('error', 'Emprunt non trouvé');
        }

        // Mettez à jour la date de retour et le statut de disponibilité du livre
        $emprunt->date_retour = now();
        $emprunt->save();

        $livre = Livre::find($emprunt->livre_id);
        $livre->disponible = true;
        $livre->save();

        return redirect()->route('emprunts.index')->with('success', 'Livre rendu avec succès');
    }


}
