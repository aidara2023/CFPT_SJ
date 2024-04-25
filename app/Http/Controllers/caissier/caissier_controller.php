<?php

namespace App\Http\Controllers\caissier;


use App\Http\Controllers\Controller;
use App\Http\Requests\caissier\caissier_request;
use App\Models\Caissier;
use App\Models\Inscription;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class caissier_controller extends Controller
{
    public function index()
    {
        $caissiers = Caissier::with('user')->orderBy('created_at', 'desc')->get();
        if($caissiers!=null){
            return response()->json([
                'statut'=>200,
                'caissier'=>$caissiers
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun donnée trouvée',
            ],500 );
        } 
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
         //$imageName=time() . '_' . $image->getClientOriginalName();
         $extension = $image->getClientOriginalExtension();
         $imageName = date('Y-m-d_H-i-s') . '.' . $extension;
         /* $image->move(public_path('image'), $imageName); 
         $userCaissier->photo=$image; */
         /* Fin upload */
         $userCaissier->photo= $image->storeAs('image', $imageName, 'public');

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
    public function validerInscription(Request $request, $id)
    {
        // Trouver l'inscription par ID
        $inscriptionsearch = Inscription::find($id);
        
    
        // Vérifier si l'inscription existe
        if ($inscriptionsearch) {
            // Mettre à jour les champs avec les données de la requête
            $inscriptionsearch->id_classe = $request->input('id_classe');
            $inscriptionsearch->id_eleve = $inscriptionsearch->id_eleve;
            $inscriptionsearch->id_annee_academique = $request->input('id_annee_academique');
            $inscriptionsearch->montant = $request->input('montant');
            $inscriptionsearch->statut = 1;
    
            // Sauvegarder les modifications
            $inscriptionsearch->save();
    
            // Retourner une réponse JSON avec un message de succès
            return response()->json([
                'statut' => 200,
                'message' => 'La mise à jour a été effectuée avec succès.',
                'inscriptionsearch' => $inscriptionsearch,
            ], 200);
        } else {
            // Retourner une réponse JSON avec un message d'erreur si l'inscription n'est pas trouvée
            return response()->json([
                'statut' => 404,
                'message' => 'L\'inscription spécifiée n\'a pas été trouvée.',
            ], 404);
        }
    }
    
    public function recherche_id_inscription(Request $request){
        $valeur = $request->input('query');
    
        $inscriptions = Inscription::with( 'eleve.user', 'classe' , 'annee_academique') 
             /* ->whereHas( function ($query) { */
                // Filtrer les utilisateurs ayant un rôle avec id_role élevé
               /*  $query->where('id_role', 1); */ // Assurez-vous de remplacer $valeur par la valeur souhaitée
           /*  })  */
            ->where('id', 'LIKE', "%$valeur%")
            ->get();
    
        if ($inscriptions->isNotEmpty()) {
            return response()->json($inscriptions);
        } else {
            return response()->json([
                'statut' => 500,
                'eleve' => 'Aucun code ne correspond à la recherche',
            ], 500);
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
