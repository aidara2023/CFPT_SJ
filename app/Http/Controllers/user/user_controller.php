<?php

namespace App\Http\Controllers\user;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\user_request;
use App\Models\Caissier;
use App\Models\Eleve;
use App\Models\Formateur;
use App\Models\Infirmier;
use App\Models\personnel_admin_appui;
use App\Models\Role;
use App\Models\Tuteur;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class user_controller extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->with('formateur.unite_de_formation.departement', 'role')->get();
        if ($user != null) {
            return response()->json([
                'statut' => 200,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
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

    public function getPersonnelAdministratif()
    {
        $roles = Role::whereNotIn('intitule', ['Eleve'])->get();

        if ($roles->isNotEmpty()) {
            $users = User::with('formateur.unite_de_formation.departement', 'role', 'personnel_admin_appui.service', 'formateur.specialite')->whereIn('id_role', $roles->pluck('id'))->get();

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
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucun rôle "Eleve" trouvé.',
            ], 500);
        }
    }

    public function getUniquementPersonnelAdministratif()
    {
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
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucun rôle "Eleve" trouvé.',
            ], 500);
        }
    }

    public function getBibliothecaire()
    {
        $roles = Role::where('intitule', "Bibliothecaire")->get();
        foreach ($roles as $role) {
            $user = User::where('id_role', $role->id)->get();
            if ($user != null) {
                return response()->json([
                    'statut' => 200,
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'Aucune donnée trouvée',
                ], 500);
            }
        }
    }


    public function store(user_request $request)
    {
        $request->validated();

        $user = new User();

        /*  Creation de matricule */
        $matricule = User::generateur_matricule();
        $user->matricule = $matricule;
        /*   Fin attribution */

        $user->nom = $request['nom'];
        $user->prenom = $request['prenom'];
        $user->genre = $request['genre'];
        $user->adresse = $request['adresse'];
        $user->email = $request['email'];
        $user->telephone = $request['telephone'];
        $user->password = Hash::make("CFPT2018");
        $user->date_naissance = $request['date_naissance'];
        $user->lieu_naissance = $request['lieu_naissance'];
        $user->nationalite = $request['nationalite'];
        $user->status = 1;

        /* Uploader une image */
        $image = $request->file('photo');
        $imageName = time() . '_' . $image->getClientOriginalName();
        //$image->move(public_path('image'), $imageName);
        $user->photo = $image->storeAs('image', $imageName, 'public');
        //$user->photo=$imageName;
        /* Fin upload */

        $user->id_role = $request->id_role;
        $user->save();

        if ($request['id_role'] == 2) {
            $formateur = new Formateur();
            $formateur->situation_matrimoniale = $request['situation_matrimoniale'];
            $formateur->type = $request['type'];
            $formateur->id_specialite = $request['id_specialite'];
            /*             $formateur->id_departement= $request['id_departement'];
 */
            $formateur->id_user = $user->id;
            $formateur->id_unite_de_formation = $request['id_unite_de_formation'];
            $formateur->save();
            event(new ModelCreated($formateur));
        } elseif ($request['id_role'] == 11) {
            $tuteur = new Tuteur();
            $tuteur->id_user = $user->id;
            $tuteur->save();
            event(new ModelCreated($tuteur));
        } elseif ($request['id_role'] == 4 || $request['id_role'] == 3 || $request['id_role'] == 5 || $request['id_role'] == 6 || $request['id_role'] == 7 || $request['id_role'] == 12 || $request['id_role'] == 14 || $request['id_role'] == 15 || $request['id_role'] == 16 || $request['id_role'] == 17 || $request['id_role'] == 22 || $request['id_role'] == 23 || $request['id_role'] == 25) {
            $personnel_admin = new Personnel_admin_appui();
            $personnel_admin->id_user = $user->id;
            $personnel_admin->id_service = $request->id_service;
            $personnel_admin->type_personnel = "Personnel Administratif";
            $personnel_admin->save();
            event(new ModelCreated($personnel_admin));
        } else {
            $personnel_appui = new Personnel_admin_appui();
            $personnel_appui->type_personnel = "Personnel Appui";
            $personnel_appui->id_user = $user->id;
            $personnel_appui->id_service = $request->id_service;
            $personnel_appui->save();
            event(new ModelCreated($personnel_appui));
        }


        if ($user != null) {
            event(new ModelCreated($user));
            return response()->json([
                'statut' => 200,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué',
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user != null) {

            $user->nom = $request['nom'];
            $user->prenom = $request['prenom'];
            $user->genre = $request['genre'];
            $user->adresse = $request['adresse'];
            $user->email = $request['email'];
            $user->telephone = $request['telephone'];
            $user->status = $user->status;


            //    if($request->filled('password')){
            //         $user->password=Hash::make($request['password']);
            //    }
            // dd($request);
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '_' . $image->getClientOriginalName();
                //$image->move(public_path('image'), $imageName);
                $user->photo = $image->storeAs('image', $imageName, 'public');
                //$user->photo=$imageName;
            }



            $user->date_naissance = $request['date_naissance'];
            $user->lieu_naissance = $request['lieu_naissance'];
            $user->nationalite = $request['nationalite'];
            $user->id_role = $request['id_role'];
            $user->id_role = $request['id_role'];


            if ($request->id_role == 2) {
                $formateur = Formateur::where('id_user', $user->id)->first();
               if ($formateur != null) {
                $formateur->situation_matrimoniale = $request['situation_matrimoniale'];
                $formateur->type = $request['type'];
                $formateur->id_specialite = $request['id_specialite'];
                $formateur->id_user = $user->id;
                $formateur->id_unite_de_formation = $request['id_unite_de_formation'];
                $formateur->save();
                event(new ModelUpdated($formateur));
               } else {
                $personnel_admin = personnel_admin_appui::where('id_user', $user->id)->first();
                if ($personnel_admin) {
                    $personnel_admin->delete();
                    $formateur = new Formateur();
                    $formateur->situation_matrimoniale = $request['situation_matrimoniale'];
                    $formateur->type = $request['type'];
                    $formateur->id_specialite = $request['id_specialite'];
                    $formateur->id_user = $user->id;
                    $formateur->id_unite_de_formation = $request['id_unite_de_formation'];
                    $formateur->save();
                    event(new ModelUpdated($formateur));
                }
               }
            } elseif ($request->id_role == 11) {
                $tuteur = Tuteur::where('id_user', $user->id)->first();
                $tuteur->id_user = $user->id;
                $tuteur->save();
                event(new ModelUpdated($tuteur));
            } elseif ($request->id_role == 4 || $request->id_role == 3 || $request->id_role == 5 || $request->id_role == 6 || $request->id_role == 7 || $request->id_role == 12 || $request->id_role == 14 || $request->id_role == 15 || $request->id_role == 16 || $request->id_role == 17 || $request->id_role == 22 || $request->id_role == 23 || $request->id_role == 25) {

                $personnel_admin = personnel_admin_appui::where('id_user', $user->id)->first();
                if ($personnel_admin) {
                    $personnel_admin->id_service =  $request['id_service'];
                    $personnel_admin->type_personnel = "Personnel Administratif";
                    $personnel_admin->save();
                    event(new ModelUpdated($personnel_admin));
                } else {
                    $formateur = Formateur::where('id_user', $user->id)->first();
                    if ($formateur) {
                        $formateur->delete();
                        $personnel_admin = new Personnel_admin_appui();
                        $personnel_admin->id_user = $user->id;
                        $personnel_admin->id_service = $request->id_service;
                        $personnel_admin->type_personnel = "Personnel Administratif";
                        $personnel_admin->save();
                        event(new ModelUpdated($personnel_admin));
                    }
                }
            } else {
                $personnel_appui = Personnel_admin_appui::where('id_user', $user->id)->first();
                $personnel_appui->type_personnel = "Personnel Appui";
                //    $personnel_appui->id_user= $user->id;
                $personnel_appui->id_service = $request->id_service;
                $personnel_appui->save();
                event(new ModelUpdated($personnel_appui));
            }
            $user->save();
            event(new ModelUpdated($user));


            return response()->json([
                'statut' => 200,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectué',
            ], 500);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user != null && $user->status == '1') {
            // Mettre à jour le statut au lieu de supprimer
            $user->status = 0; // 0 pour inactif, ajustez selon vos besoins
            $user->save();
            event(new ModelDeleted($user));

            return response()->json([
                'statut' => 200,
                'message' => 'Utilisateur désactivé avec succès',
            ], 200);
        } elseif ($user != null && $user->status == '0') {
            // Mettre à jour le statut au lieu de supprimer
            $user->status = 1; // 0 pour inactif, ajustez selon vos besoins
            $user->save();
            event(new ModelDeleted($user));

            return response()->json([
                'statut' => 200,
                'message' => 'Utilisateur désactivé avec succès',
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L utilisateur n\'est pas désactivé',
            ], 500);
        }
    }


    public function find_eleve_in_user($id)
    {
        $user = Eleve::with('user')->find($id);
        if ($user != null) {
            return response()->json([
                'statut' => 200,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L utilisateur n\'existe pas',
            ], 500);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user != null) {
            return response()->json([
                'statut' => 200,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L utilisateur n\'existe pas',
            ], 500);
        }
    }

    public function toggleUserStatus($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();

            $message = $user->status == 1 ? 'L\'utilisateur a été activé.' : 'L\'utilisateur a été désactivé.';

            return response()->json([
                'status' => 200,
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'L\'utilisateur n\'a pas été trouvé',
            ], 404);
        }
    }

    public function getServiceUtilisateurConnecte()
    {
        $user = Auth::user();

        if ($user) {
            // Liste des catégories de personnel que vous voulez vérifier
            $categoriesToCheck = ['Personnel Administratif', 'Personnel d\'appui'];

            // Vérifiez si l'utilisateur a l'une des catégories spécifiées dans la colonne categorie_personnel
            $roles = $user->role->whereIn('categorie_personnel', $categoriesToCheck)->get();

            if ($roles->isNotEmpty()) {
                // Si l'utilisateur a l'une des catégories spécifiées, vous pouvez accéder à son service
                $personnelAdmin = personnel_admin_appui::where('id_user', $user->id)->first();

                if ($personnelAdmin) {
                    $service = $personnelAdmin->service;

                    // Maintenant, vous pouvez également accéder à la direction associée
                    $direction = $service->direction->nom_direction;

                    return response()->json([
                        'status' => 200,
                        'service' => $service->nom_service,
                        'direction' => $direction,

                    ], 200);
                } else {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Aucun enregistrement de personnel administratif trouvé pour cet utilisateur.',
                    ], 500);
                }
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'L\'utilisateur n\'a pas de rôle approprié pour accéder au service.',
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Utilisateur non authentifié',
            ], 401);
        }
    }
}
