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
            return response()->json([
                'message' => 'Connexion échouée.',
                'statut' => 'Erreur'
            ], 401);
        }
    
        $user = $request->user();
        $url = '';
    
        if ($user->status == 0) {
            // Utilisateur bloqué
            $url = '/compte-bloquer';
        } else {
            switch ($user->role->intitule) {
                case "Etudiant":
                    $url = '/eleve/index';
                    break;
                case "Formateur":
                    $url = '/formateur';
                    break;
                case "Administrateur": 
                    $url = '/dashboard';
                    break;
                case "Assistante SAF":
                    $url = '/dashboard-saf';
                    break;
                case "SAF":
                    $url = '/dashboard-saf';
                    break;
                case "Caissier":
                    $url = '/dashboardCaissier';
                    break;
                case "Comptable":
                    $url = '/dashboardComptable';
                    break;
                case "Recouvrement":
                    $url = '/dashboardCaissier';
                    break;
                case "Infirmier":
                    $url = '/infirmier/index';
                    break;
                case "Bibliothecaire":
                    $url = '/bibliothecaire/accueil';
                    break;
                case "Surveillant":
                    $url = '/surveillant-dashboard';
                    break;
               /*  case "Chef Agence Comptable":
                    $url = '/recouvrement-dashboard';
                    break; */
                default:
                    return response()->json([
                        'message' => 'Rôle utilisateur inconnu.',
                        'statut' => 'Erreur'
                    ], 400);
            }
        }
    
        $token = $user->createToken('authToken')->plainTextToken;
    
        return response()->json([
            'url' => $url,
            'user' => $user,
            'token' => $token,
        ]);
    }
    


/*     public function logout(Request $request)
{
    $request->user()->tokens()->delete();
  
    return response()->json(['message' => 'Déconnexion réussie']);
} */
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    
    return response()->json([
        'message' => 'Déconnexion réussie.'
    ]);
}

}
