<?php

namespace App\Http\Controllers\eleve;

use App\Http\Controllers\Controller;
use App\Http\Requests\eleve\eleve_request;
use App\Models\Eleve;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class eleve_controller extends Controller
{
        
    public function index()
    {
        $eleves = Eleve::all();
        if($eleves!=null){
            return response()->json([
                'statut'=>200,
                'eleve'=>$eleves
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun donnée trouvée',
            ],500 );
        } 
    }

    public function show($id)
    {
        $eleves = Eleve::find($id);
        if($eleves!=null){
            return response()->json([
                'statut'=>200,
                'eleve'=>$eleves
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnee trouvée',
            ],500 );
        } 

    }

  
    public function store(eleve_request $request)
    {
        $request->validated();
        $tuteur=new User();

        /*  Creation de matricule  du teur de l'eleve*/
         $matricule= User::generateur_matricule();
         $tuteur->matricule=$matricule;
       /*   Fin attribution */
 
         $tuteur->nom=$request['nom_tuteur'];
         $tuteur->prenom=$request['prenom_tuteur'];
         $tuteur->genre=$request['genre_tuteur'];
         $tuteur->adresse=$request['adresse_tuteur'];
         $tuteur->email=$request['email_tuteur'];
         $tuteur->telephone=$request['telephone_tuteur'];
         $tuteur->password=Hash::make("CFPT2018");
         $tuteur->date_naissance=$request['date_naissance_tuteur'];
         $tuteur->lieu_naissance=$request['lieu_naissance_tuteur'];
         $tuteur->nationalite=$request['nationalite_tuteur'];

         $role= Role::where('intitule', "Tuteur");
 
         $tuteur->id_role=$role->id;
         $tuteur->save();


        $eleveUser=new User();

        /*  Creation de matricule de l'eleve*/
         $matricule= User::generateur_matricule();
         $eleveUser->matricule=$matricule;
       /*   Fin attribution */
 
         $eleveUser->nom=$request['nom_eleve'];
         $eleveUser->prenom=$request['prenom_eleve'];
         $eleveUser->genre=$request['genre_eleve'];
         $eleveUser->adresse=$request['adresse_eleve'];
         $eleveUser->email=$request['email_eleve'];
         $eleveUser->telephone=$request['telephone_eleve'];
         $eleveUser->password=Hash::make("CFPT2018");
         $eleveUser->date_naissance=$request['date_naissance_eleve'];
         $eleveUser->lieu_naissance=$request['lieu_naissance_eleve'];
         $eleveUser->nationalite=$request['nationalite_eleve'];
 
         /* Uploader une image */
         $image= $request->file('photo');
         $imageName=time() . '_' . $image->getClientOriginalName();
         $image->move(public_path('image'), $imageName);
         $eleveUser->photo=$image;
         /* Fin upload */

         $role= Role::where('intitule', "Eleve");
 
         $eleveUser->id_role=$role->id;
         $eleveUser->save();

        $eleves = Eleve::create([
            'id_user'=>$eleveUser->id,
            'contact_urgence1'=>$request['contact_urgence_1'],
            'contact_urgence2'=>$request['contact_urgence_2'],
            'id_tuteur'=>$tuteur->id,

        ]);
        if($eleves!=null){
            return response()->json([
                'statut'=>200,
                'eleve'=>$eleves,
                'message'=>'eleve enregistrer avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnee enregistrer',
            ],500 );
        } 
        
    }



    public function update(eleve_request $request, $id)
    {
        $eleves = Eleve::find($id);
        $user = $eleves -> id_user;
        $user = User::find($user);
        if($user!=null){
            $user-> nom=$request['nom'];
            $user-> prenom=$request['prenom'];
            $user-> genre=$request['genre'];
            $user-> adresse=$request['adresse'];
            $user-> telephone=$request['telephone'];
            $user-> password=$request['password'];
            $user-> date_naissance=$request['date_naissance'];
            $user-> lieu_naissance=$request['lieu_naissance'];
            $user-> nationalite =$request['nationalite'];
            if($request->hasFile('photo')){
                $image= $request->file('image');
                $imageName=time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image'), $imageName);
                $user->photo=$imageName;
               }
            $user-> photo =$user->photo;
            $user-> id_role =$request['id_role'];
            $user -> save();

            $eleves -> id_user  = $user -> id;
            $eleves->contact_urgence1=$request['contact_urgence1']; 
            $eleves->contact_urgence2=$request['contact_urgence2']; 
           
            $eleves->id_tuteur=$request['id_tuteur']; 
            $eleves->save();
            return response()->json([
                'statut'=>200,
                'eleve'=>$eleves,
                'message'=>'Élève mis à jour avec succès',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun donner modifier',
            ],500 );
        };

       
    }

    public function delete($id)
    {
        $eleve = Eleve::find($id);
        if($eleve!=null){
            $eleve->destroy();
            return response()->json([
                'statut'=>200,
                'message'=>'eleve supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'eleve non supprimer',
            ],500 );
        }
        
        
    }

}
