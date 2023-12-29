<?php

namespace App\Http\Controllers\tuteur;

use App\Http\Controllers\Controller;
use App\Http\Requests\tuteur\tuteur_request;
use App\Models\Role;
use App\Models\Tuteur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class tuteur_controller extends Controller
{
    public function index(){
        $tuteur = Tuteur::orderBy('created_at', 'desc')->get();
        if($tuteur != null){
            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée'
            ],500);
        }
    }

    public function store(tuteur_request $request){
        $validatedData = $request->validated();

        $usertuteur=new User();

        /*  Creation de matricule de tuteur*/
         $matricule= User::generateur_matricule();
         $usertuteur->matricule=$matricule;
       /*   Fin attribution */
 
         $usertuteur->nom=$request['nom_tuteur'];
         $usertuteur->prenom=$request['prenom_tuteur'];
         $usertuteur->genre=$request['genre_tuteur'];
         $usertuteur->adresse=$request['adresse_tuteur'];
         $usertuteur->email=$request['email_tuteur'];
         $usertuteur->telephone=$request['telephone_tuteur'];
         $usertuteur->password=Hash::make("CFPT2018");
         $usertuteur->date_naissance=$request['date_naissance_tuteur'];
         $usertuteur->lieu_naissance=$request['lieu_naissance_tuteur'];
         $usertuteur->nationalite=$request['nationalite_tuteur'];
 
         /* Uploader une image */
         $image= $request->file('photo');
         $imageName=time() . '_' . $image->getClientOriginalName();
         $image->move(public_path('image'), $imageName);
         $usertuteur->photo=$image;
         /* Fin upload */

         $role= Role::where('intitule', "tuteur")->first();
 
         $usertuteur->id_role=$role->id;
         $usertuteur->save();
        $tuteur=tuteur::create([
            'id_user'=>$usertuteur->id
        ]);

        if($tuteur != null){
            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été ajouté'
            ],500);
        }
    }

    public function update(tuteur_request $request, $id) {
        $tuteur = Tuteur::find($id);
        $user = $tuteur -> id_user;
        $user = User::find($user);
        if($user != null){
            $user-> nom=$request['nom'];
            $user-> prenom=$request['prenom'];
            $user-> genre=$request['genre'];
            $user-> adresse=$request['adresse'];
            $user-> telephone=$request['telephone'];
            $user-> password=$request['password'];
            $user-> date_naissance=$request['date_naissance'];
            $user-> lieu_naissance=$request['lieu_naissance'];
            $user-> nationalite =$request['nationalite'];
            $user-> photo =$request['photo'];
            $user-> id_role =$request['id_role'];
            $user -> save();

            $tuteur -> id_user = $user -> id;
            $tuteur -> save();

            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function delete($id) {
        $tuteur = Tuteur::find($id);
        if($tuteur != null){
            $tuteur -> delete();
            return response()->json([
                'statut' => 200,
                'message' => 'L\'enregistrement a été supprimé avec succés'
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été supprimé'
            ],500);
        }
    }

    public function show($id) {
        $tuteur = Tuteur::find($id);
        if($tuteur != null){
            return response()->json([
                'statut' => 200,
                'tuteur' => $tuteur
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'tuteur' => 'Ce tuteur n\'existe pas'
            ],500);
        }
    }
}
