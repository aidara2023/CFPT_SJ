<?php

namespace App\Http\Controllers\bibliothecaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\bibliothecaire\bibliothecaire_request;
use App\Models\Bibliothecaire;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class bibliothecaire_controller extends Controller
{
    
    public function index() {
        $bibliothecaire=Bibliothecaire::orderBy('created_at', 'desc')->get();
        if($bibliothecaire!=null){
            return response()->json([
                'statut'=>200,
                'bibliothecaire'=>$bibliothecaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function store (bibliothecaire_request $request){
        $data=$request->validated();
        $userbibliothecaire=new User();

        /*  Creation de matricule de l'eleve*/
         $matricule= User::generateur_matricule();
         $userbibliothecaire->matricule=$matricule;
       /*   Fin attribution */
 
         $userbibliothecaire->nom=$request['nom'];
         $userbibliothecaire->prenom=$request['prenom'];
         $userbibliothecaire->genre=$request['genre'];
         $userbibliothecaire->adresse=$request['adresse'];
         $userbibliothecaire->email=$request['email'];
         $userbibliothecaire->telephone=$request['telephone'];
         $userbibliothecaire->password=Hash::make("CFPT2018");
         $userbibliothecaire->date_naissance=$request['date_naissance'];
         $userbibliothecaire->lieu_naissance=$request['lieu_naissance'];
         $userbibliothecaire->nationalite=$request['nationalite'];
 
         /* Uploader une image */
         $image= $request->file('photo');
         //$imageName=time() . '_' . $image->getClientOriginalName();
         $extension = $image->getClientOriginalExtension();
         $imageName = date('Y-m-d_H-i-s') . '.' . $extension;
         $image->move(public_path('image'), $imageName);
         $userbibliothecaire->photo=$image;
         /* Fin upload */

         $role= Role::where('intitule', "Bibliothecaire")->first();
 
         $userbibliothecaire->id_role=$role->id;
         $userbibliothecaire->save();

        $bibliothecaire=Bibliothecaire::create([
            'id_service'=>$request['id_service'],
            'id_user'=>$userbibliothecaire->id
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
    public function update(Request $request, $id){
        $bibliothecaire=Bibliothecaire::find($id);
        $user=$bibliothecaire->id_user;
        $user=user::find($user);
        if($bibliothecaire!=null){
            $user->nom=$request['nom'];
            $user->prenom=$request['prenom'];
            $user->genre=$request['genre'];
            $user->adresse=$request['adresse'];
            $user->telephone=$request['telephone'];
            $user->password=$request['password'];
            $user->date_naissance=$request['date_naissance'];
            $user->lieu_naissance=$request['lieu_naissance'];
            $user->nationalite=$request['nationalite'];
            $user->photo=$request['photo'];
            $user->id_role=$request['id_role'];
            $user->save();
           $bibliothecaire->id_user=$user->id;
           $bibliothecaire->id_service=$request['id_service'];
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

