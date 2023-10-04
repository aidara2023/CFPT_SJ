<?php

namespace App\Http\Controllers\caissier;


use App\Http\Controllers\Controller;
use App\Http\Requests\caissier\caissier_request;
use App\Models\Caissier;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class caissier_controller extends Controller
{
    public function index(){

        $data = Caissier::all();
        return response()->json($data);
    }
    public function store(caissier_request $request){
        $validatedData = $request->validated();

        $userCaissier=new User();

        /*  Creation de matricule de l'eleve*/
         $matricule= User::generateur_matricule();
         $userCaissier->matricule=$matricule;
       /*   Fin attribution */
 
         $userCaissier->nom=$request['nom_caissier'];
         $userCaissier->prenom=$request['prenom_caissier'];
         $userCaissier->genre=$request['genre_caissier'];
         $userCaissier->adresse=$request['adresse_caissier'];
         $userCaissier->email=$request['email_caissier'];
         $userCaissier->telephone=$request['telephone_caissier'];
         $userCaissier->password=Hash::make("CFPT2018");
         $userCaissier->date_naissance=$request['date_naissance_caissier'];
         $userCaissier->lieu_naissance=$request['lieu_naissance_caissier'];
         $userCaissier->nationalite=$request['nationalite_caissier'];
 
         /* Uploader une image */
         $image= $request->file('photo');
         $imageName=time() . '_' . $image->getClientOriginalName();
         $image->move(public_path('image'), $imageName);
         $userCaissier->photo=$image;
         /* Fin upload */

         $role= Role::where('intitule', "Caissier")->first();
 
         $userCaissier->id_role=$role->id;
         $userCaissier->save();
        $caissier=Caissier::create([
            'id_service'=>$request['id_service'],
            'id_user'=>$userCaissier->id
        ]);

        if($caissier!=null){
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
        
    }

    public function update(caissier_request $request, $id){
        $caissier=Caissier::find($id);
        if($caissier!=null){
           $caissier->id_service=$request['id_service']; 
           $caissier->id_user=$request['id_user'];
           $caissier->save();
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $caissier=Caissier::find($id);
        if($caissier!=null){
            $caissier->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'caissier supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'caissier non supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $caissier=Caissier::find($id);
        if($caissier!=null){
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissier
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'caissier n\'existe pas ',
            ],500 );
        }
    }
}
