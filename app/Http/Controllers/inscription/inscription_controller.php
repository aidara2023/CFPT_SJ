<?php

namespace App\Http\Controllers\inscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\inscription\inscription_request;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Role;
use App\Models\Tuteur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class inscription_controller extends Controller
{
    public function index() {
        $inscription=Inscription::all();
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
         $tuteur_user->email=$request['mail_tuteur'];
         $tuteur_user->telephone=$request->telephone_tuteur;
         $tuteur_user->password=Hash::make("CFPT2018");
         $tuteur_user->date_naissance=$request->date_naissance_tuteur;
         $tuteur_user->lieu_naissance=$request->lieu_naissance_tuteur;
         $tuteur_user->nationalite=$request->nationalite_tuteur;

        //  /* Uploader une image */
        //  $image= $request->file('photo');
        //  $imageName=time() . '_' . $image->getClientOriginalName();
        //  $image->move(public_path('image'), $imageName);
        //  $tuteur_user->photo=$image;
        //  /* Fin upload */
        $role= Role::where('intitule', 'Tuteur')->first();
         $tuteur_user->id_role=$role->id;
         $tuteur_user->save();

        //   /*  Creation de matricule */
        //   $matriculeTueur= User::generateur_matricule();
        // /*   Fin attribution */
        // $tuteur_user=User::create([
        //     'matricule'=>$matriculeTueur,
        //     'nom'=>$request->nom_tuteur,
        //     'prenom'=>$request->prenom_tuteur,
        //     'genre'=>$request->genre_tuteur,
        //     'adresse'=>$request->adresse_tuteur,
        //     'telephone'=>$request->telephone_tuteur,
        //     'date_naissance'=>$request->date_naissance_tuteur,
        //     'lieu_naissance'=>$request->lieu_naissance_tuteur,
        //     'nationalite'=>$request->nationalite_tuteur
        // ]);

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
         $eleve_user->email=$request['mail_eleve'];
         $eleve_user->telephone=$request->telephone_eleve;
         $eleve_user->password=Hash::make("CFPT2018");
         $eleve_user->date_naissance=$request->date_naissance_eleve;
         $eleve_user->lieu_naissance=$request->lieu_naissance_eleve;
         $eleve_user->nationalite=$request->nationalite_eleve;

         /* Uploader une image */
         $image= $request->file('photo');
         $imageName=time() . '_' . $image->getClientOriginalName();
         $image->move(public_path('image'), $imageName);
         $eleve_user->photo=$image;
         /* Fin upload */

        $role= Role::where('intitule', 'Eleve')->first();
         $eleve_user->id_role=$role->id;
         $eleve_user->save();

        // /* Uploader une image */
        // $image= $request->file('photo');
        // $imageName=time() . '_' . $image->getClientOriginalName();
        // $image->move(public_path('image'), $imageName);
        // /* Fin upload */

        // /*  Creation de matricule */
        // $matriculeEleve= User::generateur_matricule();
        // /*   Fin attribution */
        // $eleve_user=User::create([
        //     'matricule'=>$matriculeEleve,
        //     'nom'=>$request->nom_eleve,
        //     'prenom'=>$request->prenom_eleve,
        //     'genre'=>$request->genre_eleve,
        //     'adresse'=>$request->adresse_eleve,
        //     'telephone'=>$request->telephone_eleve,
        //     'date_naissance'=>$request->date_naissance_eleve,
        //     'lieu_naissance'=>$request->lieu_naissance_eleve,
        //     'nationalite'=>$request->nationalite_eleve,
        //     'photo'=>$image
        // ]);


        $eleve=Eleve::create([
        'contact_urgence1'=>$request->contact_urgence1,
        'contact_urgence2'=>$request->contact_urgence2,
        'id_tuteur'=>$tuteur->id,
        'id_user'=>$eleve_user->id

        ]);

        /* Uploader les dossiers */
        // $dossier= $request->file('dossier');
        // $dossierName=time() . '_' . $dossier->getClientOriginalName();
        // $dossier->move(public_path('dossier'), $dossierName);
        if ($request->hasFile('dossier') && $request->file('dossier')->isValid()) {
            $dossier = $request->file('dossier');

            // Vérification du type de fichier
            if ($dossier->getClientOriginalExtension() === 'pdf') {
                // Validation de la taille du fichier (exemple : limite de 5 Mo)
                if ($dossier->getClientSize() < 5000000) {
                    $dossierName = time() . '_' . $dossier->getClientOriginalName();
                    $dossier->move(public_path('dossier'), $dossierName);
                    // Ajouter ici le code pour enregistrer le nom du fichier dans la base de données ou effectuer d'autres opérations nécessaires
                } else {
                    // Gérer la taille de fichier invalide
                    // return back()->with('error', 'La taille du fichier est trop importante. Veuillez télécharger un fichier PDF de taille inférieure à 5 Mo.');
                    return 1;
                }
            } else {
                // Gérer les types de fichiers non autorisés
                // return back()->with('error', 'Seuls les fichiers PDF sont autorisés.');
                return 2;
            }
        } else {
            // Gérer les erreurs d'upload
            // return back()->with('error', 'Une erreur est survenue lors du téléchargement du fichier. Veuillez réessayer.');
            return 3;
        }

        /* Fin upload */

        $inscription=Inscription::create([
            'montant'=>$request->montant,
            'date_inscription'=>now(),
            'id_eleve'=>$eleve->id,
            'id_classe'=>$request->id_classe,
            'id_annee_academique'=>$request->id_annee_accademique,
            'dossier'=>$dossier
        ]);
        if($inscription!=null){
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

        $validatedData = $request->validated();

        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }


        $inscription->update($validatedData);


        return response()->json($inscription);
    }

    public function delete($id)
    {

        $inscription = Inscription::find($id);

        if (!$inscription) {
            return response()->json(['message' => 'Inscription non trouvée'], 404);
        }


        $inscription->delete();


        return response()->json(['message' => 'Inscription supprimée avec succès']);
    }




}
