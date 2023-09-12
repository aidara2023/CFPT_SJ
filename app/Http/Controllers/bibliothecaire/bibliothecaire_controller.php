<?php

namespace App\Http\Controllers\bibliothecaire;

use App\Http\Controllers\Controller;
use App\Models\Bibliothecaire;
use App\Models\User;
use Illuminate\Http\Request;

class bibliothecaire_controller extends Controller
{
    
    public function index() {
        $bibliothecaire=Bibliothecaire::all();
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun enregistrement n\'a été éffectué',
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
        $bibliothecaire=Bibliothecaire::create([
            'id_service'=>$request['id_service'],
            'id_user'=>$user->id
        ]);
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function Update(Request $request, $id){
        $bibliothecaire=Bibliothecaire::find($id);
        if($bibliothecaire!=null){
           $bibliothecaire->id_service=$request['id_service']; 
           $bibliothecaire->id_user=$request['id_user'];
           $bibliothecaire->save();
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $bibliothecaire=Bibliothecaire::find($id);
        if($bibliothecaire!=null){
            $bibliothecaire->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Bibliothecaire supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Bibliothecaire non supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $bibliothecaire=Bibliothecaire::find($id);
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Bibliothecaire n\'existe pas ',
            ],500 );
        }
    }

}
