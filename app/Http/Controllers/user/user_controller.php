<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\user_request;
use App\Models\Caissier;
use App\Models\Formateur;
use App\Models\Infirmier;
use App\Models\Role;
use App\Models\Tuteur;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class user_controller extends Controller
{
    public function index() {
        $user=User::orderBy('created_at', 'desc')->get();
        if($user!=null){
            return response()->json([
                'statut'=>200,
                'user'=>$user
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
    }

    // public function getPersonnelAdministratif() {
    //     $roles= Role::whereNotIn('intitule', ['Eleve'])->get();
    //     foreach($roles as $role){
    //         $user=User::where('id_role', $role->id)->get();
    //         if($user!=null){
    //             return response()->json([
    //                 'statut'=>200,
    //                 'user'=>$user
    //             ],200)  ;
    //         }else{
    //             return response()->json([
    //                 'statut'=>500,
    //                 'message'=>'Aucune donnée trouvée',
    //             ],500 );
    //         }

    //     }
    // }

    public function getPersonnelAdministratif() {
        $roles = Role::whereNotIn('intitule', ['Eleve'])->get();

        if ($roles->isNotEmpty()) {
            $users = User::whereIn('id_role', $roles->pluck('id'))->with('role')->get();

            if ($users->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'user' => $users,
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Aucun utilisateur trouvé pour les rôles spécifiés.',
                ], 500);
            }
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Aucun rôle "Eleve" trouvé.',
            ],500);
        }
    }

    public function getUniquementPersonnelAdministratif() {
        $roles = Role::where('categorie_personnel', ['Personnel Administratif'])->get();

        if ($roles->isNotEmpty()) {
            $users = User::whereIn('id_role', $roles->pluck('id'))->with('role')->get();

            if ($users->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'user' => $users,
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Aucun utilisateur trouvé pour les rôles spécifiés.',
                ], 500);
            }
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Aucun rôle "Eleve" trouvé.',
            ],500);
        }
    }

    public function getBibliothecaire() {
        $roles= Role::where('intitule', "Bibliothecaire")->get();
        foreach($roles as $role){
            $user=User::where('id_role', $role->id)->get();
            if($user!=null){
                return response()->json([
                    'statut'=>200,
                    'user'=>$user
                ],200)  ;
            }else{
                return response()->json([
                    'statut'=>500,
                    'message'=>'Aucune donnée trouvée',
                ],500 );
            }

        }
    }


    public function store (user_request $request){
        $request->validated();

        $user=new User();

       /*  Creation de matricule */
        $matricule= User::generateur_matricule();
        $user->matricule=$matricule;
      /*   Fin attribution */

        $user->nom=$request['nom'];
        $user->prenom=$request['prenom'];
        $user->genre=$request['genre'];
        $user->adresse=$request['adresse'];
        $user->email=$request['email'];
        $user->telephone=$request['telephone'];
        $user->password=Hash::make("CFPT2018");
        $user->date_naissance=$request['date_naissance'];
        $user->lieu_naissance=$request['lieu_naissance'];
        $user->nationalite=$request['nationalite'];
        $user->status=1;

        /* Uploader une image */
        $image= $request->file('photo');
        $imageName=time() . '_' . $image->getClientOriginalName();
        //$image->move(public_path('image'), $imageName);
        $user->photo= $image->storeAs('image', $imageName, 'public');
        //$user->photo=$imageName;
        /* Fin upload */

        $user->id_role=$request['id_role'];
        $user->save();

        if($request['id_role']==2){
            $formateur= new Formateur();
            $formateur->situation_matrimoniale= $request['situation_matrimoniale'];
            $formateur->type= $request['type'];
            $formateur->id_specialite= $request['id_specialite'];
/*             $formateur->id_departement= $request['id_departement'];
 */         $formateur->id_user= $user->id;
            $formateur->id_unite_de_formation= $request['id_unite_de_formation'];
            $formateur->save();
        }
        
        elseif($request['id_role']==11){
            $tuteur=new Tuteur();
            $tuteur->id_user= $user->id;
            $tuteur->save();
        }
        elseif($request['id_role']==4){
                $caissier=new Caissier();
                $caissier->id_user= $user->id;
                $caissier->id_service= $request->id_service;
                $caissier->save();
            }
            elseif($request['id_role']==3){
                $infirmier=new Infirmier();
                $infirmier->id_user= $user->id;
                $infirmier->save();
            }
        

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
    public function mis_ajour(Request $request, $id){
        $user=User::find($id);
        if($user!=null){
           $user->nom=$request['nom'];
           $user->prenom=$request['prenom'];
           $user->genre=$request['genre'];
           $user->adresse=$request['adresse'];
           $user->email=$request['email'];
           $user->telephone=$request['telephone'];

           if($request->filled('password')){
                $user->password=Hash::make($request['password']);
           }

           if($request->hasFile('photo')){
            $image= $request->file('image');
            $imageName=time() . '_' . $image->getClientOriginalName();
            //$image->move(public_path('image'), $imageName);
            $user->photo= $image->storeAs('image', $imageName, 'public');
            //$user->photo=$imageName;
           }

           $user->date_naissance=$request['date_naissance'];
           $user->lieu_naissance=$request['lieu_naissance'];
           $user->nationalite=$request['nationalite'];
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
                'message'=>'Utilisateur supprimer avec succes',
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
                'message'=>'L utilisateur n\'existe pas',
            ],500 );
        }

    }
}
