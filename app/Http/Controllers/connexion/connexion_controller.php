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
                'url'=>$url, 
                'user'=>$user
             ]);
            }

            elseif($role=="Comptable"){
                $url='/comptable/index';
                return response([
                    'url'=>$url, 
                    'user'=>$user
                 ]);
    
            }
            elseif($role=="Infirmier"){
                $url='/infirmier/index';
                return response([
                    'url'=>$url, 
                    'user'=>$user
                 ]);
    
            }
            elseif($role=="Bibliothecaire"){
                $url='/bibliothecaire/index';
                return response([
                    'url'=>$url, 
                    'user'=>$user
                 ]);
    
            }
            elseif($role=="Surveillant"){
                $url='/surveillant/index';
                return response([
                    'url'=>$url, 
                    'user'=>$user
                 ]);
    
            }

        
         
   /*  elseif($role=="Personnel Appui"){

        if($user->role->appui->intitule=="Vigile"){
            //a creer
            $url='/vigile/index';
            return response([
                'url'=>$url, 
                'user'=>$user
             ]);
            }
            elseif($user->role->appui->intitule=="Femme de menage"){
                //continuer le nom des personnel d'appui

            }
    } */
        
        else{
            $url='/login';
            return response([
                'url'=>$url,
                'statut'=>'Error'
            ]);

        }

       
   
}

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
