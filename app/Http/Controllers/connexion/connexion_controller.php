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
            switch (strtolower($user->role->intitule)) {
                case "etudiant":
                    $url = '/eleve/index';
                    break;
                case "formateur":
                    $url = '/dashboard';
                    break;
                case "administrateur": 
                    $url = '/dashboard';
                    break;
                case "assistante saf":
                    $url = '/dashboard-saf';
                    break;
                case "saf":
                    $url = '/dashboard-saf';
                    break;
                case "caissier":
                    $url = '/dashboardCaissier';
                    break;
                case "comptable":
                    $url = '/dashboardComptable';
                    break;
                case "recouvrement":
                    $url = '/dashboardCaissier';
                    break;
                case "infirmier":
                    $url = '/infirmier/index';
                    break;
                case "bibliothecaire":
                    $url = '/bibliothecaire/accueil';
                    break;
                case "surveillant":
                    $url = '/surveillant-dashboard';
                    break;
                case "assistante dg":
                    $url = '/dashboardCaissierDAF';
                    break; 
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
