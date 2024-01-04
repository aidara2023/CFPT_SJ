<?php

namespace App\Http\Controllers\connexion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class connexion_controller extends Controller
{
    public function connexion(Request $request)
    {
        if (!Auth::attempt($request->only('matricule', 'password'))) {
            return response([
                'message' => 'Connexion échouée',
                'statut' => 'Error'
            ]);
        }

        $user = Auth::user();
        $role = $user->role->intitule;

        if ($user->status === 0) {
            // Utilisateur bloqué
            Auth::logout();
            return response([
                'message' => 'Vous avez été bloqué, rapprochez-vous de votre administrateur pour plus d\'informations.',
                'statut' => 'Blocked'
            ]);
        }

        $url = '';
        switch ($role) {
            case "Etudiant":
                $url = 'eleve/index';
                break;
            case "Formateur":
                $url = 'formateur';
                break;
            case "Administrateur":
                $url = '/admin/index';
                break;
            case "Caissier":
                $url = '/caissier/accueil';
                break;
            case "Comptable":
                $url = '/comptable/index';
                break;
            case "Infirmier":
                $url = '/infirmier/index';
                break;
            case "Bibliothecaire":
                $url = '/bibliothecaire/index';
                break;
            case "Surveillant":
                $url = '/surveillant/index';
                break;
            default:
                $url = '/login';
        }

        return response([
            'url' => $url,
            'user' => $user
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
