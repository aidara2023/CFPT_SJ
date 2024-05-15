<?php

namespace App\Http\Controllers\inscription;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\inscription\inscription_request;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Role;
use App\Models\Tuteur;
use App\Models\Unite_de_formation;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class inscription_controller extends Controller
{
    public function index() {
        $inscription=Inscription::with('annee_academique', 'eleve.user', 'classe', 'classe.type_formation', 'eleve.tuteur.user', 'classe.unite_de_formation', 'classe.unite_de_formation.departement')->orderBy('created_at', 'desc')->get();
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
     
    public function index_val(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $inscription=Inscription::where('statut', 1)->with('annee_academique', 'eleve.user', 'classe', 'classe.type_formation', 'eleve.tuteur.user', 'classe.unite_de_formation', 'classe.unite_de_formation.departement')->orderBy('created_at', 'desc')->paginate($perPage);;
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function index_inval(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $inscription=Inscription::where('statut', 0)->with('annee_academique', 'eleve.user', 'classe', 'classe.type_formation', 'eleve.tuteur.user', 'classe.unite_de_formation', 'classe.unite_de_formation.departement')->orderBy('created_at', 'desc')->paginate($perPage);;
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
    public function last() {
        $inscription=Inscription::with('annee_academique', 'eleve.user', 'classe', 'classe.type_formation', 'eleve.tuteur.user', 'classe.unite_de_formation', 'classe.unite_de_formation.departement')->take(7)->orderBy('created_at', 'desc')->get();
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
     public function verifMail(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'email' => [
                 'required',
                 'email',
                 Rule::unique('users')->ignore(auth()->id()),
             ],
             // Ajoutez d'autres règles de validation pour les champs nécessaires
         ]);
 
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 422);
         }
 
         // Le reste de votre code pour le traitement du formulaire
 
         return response()->json(['success' => true]);
     }
 

     public function show($id){

        $inscription=Inscription::find($id);
        if($inscription!=null){
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Inscription introuvable ',
            ],500 );
        }
    }

    public function store (inscription_request $request){
        $request->validated();

        $tuteur_user=new User();

        /*  Creation de matricule */
         $matricule= User::generateur_matricule();
         $tuteur_user->matricule=$matricule;
       /*   Fin attribution */

         $tuteur_user->nom=$request->nom_tuteur;
         $tuteur_user->prenom=$request->prenom_tuteur;
         $tuteur_user->genre=$request->genre_tuteur;
         $tuteur_user->adresse=$request->adresse_tuteur;
         $tuteur_user->email=$request->mail_tuteur;
         $tuteur_user->telephone=$request->telephone_tuteur;
         $tuteur_user->password=Hash::make("CFPT2018");
         $tuteur_user->date_naissance=$request->date_naissance_tuteur;
         $tuteur_user->lieu_naissance=$request->lieu_naissance_tuteur;
         $tuteur_user->nationalite=$request->nationalite_tuteur;


        $role= Role::where('intitule', 'Tuteur')->first();
        $tuteur_user->id_role=$role->id;
        $tuteur_user->save();

        $tuteur=Tuteur::create([
            'id_user'=>$tuteur_user->id,
        ]);


        $eleve_user=new User();

        /*  Creation de matricule */
         $matriculeEleve= User::generateur_matricule();
         $eleve_user->matricule=$matriculeEleve;
       /*   Fin attribution */

         $eleve_user->nom=$request->nom_eleve;
         $eleve_user->prenom=$request->prenom_eleve;
         $eleve_user->genre=$request->genre_eleve;
         $eleve_user->adresse=$request->adresse_eleve;
         $eleve_user->email=$request->mail_eleve;
         $eleve_user->telephone=$request->telephone_eleve;
         $eleve_user->password=Hash::make("CFPT2018");
         $eleve_user->date_naissance=$request->date_naissance_eleve;
         $eleve_user->lieu_naissance=$request->lieu_naissance_eleve;
         $eleve_user->nationalite=$request->nationalite_eleve;

         /* Uploader une image */
         $image= $request->file('photo');
        // $imageName=time() . '_' . $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $imageName = date('Y-m-d_H-i-s') . '.' . $extension;
         $eleve_user->photo= $image->storeAs('image', $imageName, 'public');
        /*  $image->move(public_path('image'), $imageName);
         $eleve_user->photo=$image; */
        
         /* Fin upload */

        $roleEleve= Role::where('intitule', 'Eleve')->first();
         $eleve_user->id_role=$roleEleve->id;
         $eleve_user->save();




        $eleve=Eleve::create([
        'contact_urgence1'=>$request->contact_urgence1,
        'contact_urgence2'=>$request->contact_urgence2,
        'id_tuteur'=>$tuteur->id,
        'id_user'=>$eleve_user->id,
        'id_kairos'=>$request->id_kairos,

        ]);


        $inscription=Inscription::create([
            'montant'=>$request->montant,
            'date_inscription'=>now(),
            'id_eleve'=>$eleve->id,
            'id_classe'=>$request->id_classe,
            'id_annee_academique'=>$request->id_annee_accademique,
           
            /* 'dossier'=>$dossier */
        ]);

        if($inscription!=null){
            event(new ModelCreated($inscription));
            return response()->json([
                'statut'=>200,
                'inscription'=>$inscription
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'L\'inscription est introuvable',
            ],500 );
        }
    }

    public function update(inscription_request $request, $id)
    {
        $inscription = Inscription::find($id);
    
        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

    
        $inscription->montant = $request->montant;
        $inscription->id_annee_academique = $request->id_annee_academique;
    
        $inscription->save();
       event(new ModelUpdated($inscription));

        return response()->json($inscription);
    } 

    public function delete($id)
    {
        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }

        $inscription->delete();
        event(new ModelDeleted($inscription));


        return response()->json(['message' => 'Inscription supprimée avec succès']);
    }

    public function get_filiere_by_departement($id){
        $filiere=Unite_de_formation::where('id_departement', $id)->get();

        if($filiere!=null){
            return response()->json([
                'statut'=>200,
                'filiere'=>$filiere
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Filiere introuvable ',
            ],500 );
        }
    }
    public function get_classe_by_filiere($id){
        $classe=Classe::with('unite_de_formation', 'type_formation')->where('id_unite_de_formation', $id)->get();

        if($classe!=null){
            return response()->json([
                'statut'=>200,
                'classe'=>$classe
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Classe introuvable ',
            ],500 );
        }
       



        

     }
    public function getEleveIdByInscriptionId($id)
    {
        $inscription = Inscription::with( 'eleve.user', 'classe' , 'annee_academique')->find($id);
    
        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }
    
      /*   $eleveId = $inscription->id_eleve; */
        $eleve = $inscription;
    
       /*  return response()->json(['eleve_id' => $eleveId]); */
        return response()->json(['eleve' => $eleve]);
    }



}
