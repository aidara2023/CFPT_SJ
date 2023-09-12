<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index() {
        $user=User::all();
        if($user!=null){
            return response()->json([
                'statut'=>200,
                'user'=>$user
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }
    public function ajouter (Request $request){
        $data=$request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'genre'=>'required',
            'adresse'=>'required',
            'email'=>'required',
            'telephone'=>'required',
            'password'=>'required',
            'date_naissance'=>'required',
            'lieu_naissance'=>'required',
            'nationalite'=>'required',
            'photo'=>'required',
            'id_role'=>'required'
        ]);
        $user=User::create($data);
        if($user!=null){
            return response()->json([
                'statut'=>200,
                'user'=>$user
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function mis_ajour(Request $request, $id){
        $user=User::find($id);
        if($user!=null){
           $user->nom=$request['nom'];
           $user->prenom=$request['prenom'];
           $user->genre=$request['genre'];
           $user->adresse=$request['adresse'];
           $user->telephone=$request['telephone'];
           $user->password=$request['password'];
           $user->date_naissance=$request['date_naissance'];
           $user->nom=$request['lieu_naissance'];
           $user->nationalite=$request['nationalite'];
           $user->photo=$request['photo'];
           $id_role->nom=$request['id_role'];
           $user->save();
            return response()->json([
                'statut'=>200,
                'user'=>$user
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $user=User::find($id);
        if($user!=null){
            $user->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'utilisateur supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L utilisateur n\'est pas supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $user=User::find($id);
        if($user!=null){
            return response()->json([
                'statut'=>200,
                'user'=>$user
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L utilisateur n\'existe pas été éffectué',
            ],500 );
        }
       
    }
}
