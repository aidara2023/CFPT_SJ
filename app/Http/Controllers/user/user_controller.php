<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\user_request;
use Illuminate\Http\Request;
use App\Models\User;
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

    public function store (user_request $request){
        $data=$request->validated();
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
    public function update(user_request $request, $id){
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
           $user->id_role=$request['id_role'];
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
    public function delete($id){
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
