<?php

namespace App\Http\Controllers\connexion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class connexion_controller extends Controller
{
    public function connexion(Request $request){
        if(!Auth::attempt($request->only('matricule','password'))){
            return response([
                'message'=>'Connexion échouée',
                'statut'=>'Error'
            ]);
        }
        $user=Auth::user();
        $role=$user->role->intitule ;
        $url='';
        if($role=="etudiant"){
            $url='eleve/index';
            return response([
                'url'=>$url, 
                'user'=>$user
             ]);
        }elseif($role=="formateur"){
            $url='formateur';
            return response([
                'url'=>$url, 
                'user'=>$user
             ]);

        } 
        elseif($role=="Administrateur"){
            $url='/admin/index';
            return response([
                'url'=>$url, 
                'user'=>$user
             ]);

        } 
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
        return view('auth.login');
    }
}
