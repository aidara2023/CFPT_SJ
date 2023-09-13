<?php

namespace App\Http\Controllers\infirmier;

use App\Http\Controllers\Controller;
use App\Models\Infirmier;
use App\Models\User;
use Illuminate\Http\Request;

class infirmier_controller extends Controller
{
    public function index() {
        $infirmier=Infirmier::all();
        if($infirmier!=null){
            return response()->json([
                'statut'=>200,
                'infirmier'=>$infirmier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,  
                'message'=>'aucun nom d infirmier  n\'a été enregistrée',
            ],500 );
        }
     }

     public function store (Request $request){
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
            'id_role'=>'required',
            'id_service'=>'required'
        ]);
        $user=User::create($data);
        $infirmier=Infirmier::create([
             'id_service'=>$request['id_service'],
            'id_user'=>$user->id
        ]);
        if($infirmier!=null){
            return response()->json([
                'statut'=>200,
                'infirmier'=>$infirmier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(Request $request, $id){
        $infirmier=Infirmier::find($id);
        $user=$infirmier ->id_user;
        $user=User::find($user);
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


           $infirmier->intitule=$request['intitule'];
           $infirmier->id_user=$user ->id;
           $infirmier->save();
           

            return response()->json([
                'statut'=>200,
                'infirmier'=>$infirmier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour de l\'infirmier n\'a pas été éffectuée',
            ],500 );
        }
    }

    public function delete($id){
        $infirmier=Infirmier::find($id);
        if($infirmier!=null){
            $infirmier->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'L\'infirmier a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression de l\'infirmier',
            ],500 );
        }
       
    }


    public function show($id){
        $infirmier=Infirmier::find($id);
        if($infirmier!=null){
            return response()->json([
                'statut'=>200,
                'infirmier'=>$infirmier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'infirmier n\'existe pas ',
            ],500 );
        }
       
    }
}
