<?php

namespace App\Http\Controllers\eleve;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use Illuminate\Http\Request;
use App\Models\User;

class eleve_controller extends Controller
{
        //
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
                'message'=>'aucun donner trouver',
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
                'message'=>'aucun donner trouver',
            ],500 );
        } 

       // return view('eleves.show', ['eleve' => $eleve]);
    }


/*
    public function create()
    {
        return view('eleves.create');
    }
*/    
    public function store(Request $request)
    {
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
        $eleves = Eleve::create([
            'id_user'=>$user->id,
            'id'=>$request['id'],
            'contact_urgence1'=>$request['contact_urgence1'],
            'contact_urgence2'=>$request['contact_urgence2'],
            'id_tuteur'=>$request['id_tuteur']

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
                'message'=>'aucun donner enregistrer',
            ],500 );
        } 
        
        // Eleve::create([
        //     'nom' => $request->input('nom'),
        //   'prenom' => $request->input('prenom'),
        // Ajoutez d'autres attributs ici
        //]);
    
        //return redirect()->route('eleves.index')->with('success', 'Élève ajouté avec succès');
    }


/*
    public function edit($id)
    {
        $eleve = Eleve::find($id);
        return view('eleves.edit', ['eleve' => $eleve]);
    }
*/
    public function update(Request $request, $id)
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
            $user-> photo =$request['photo'];
            $user-> id_role =$request['id_role'];
            $user -> save();

            $eleves -> id_user  = $user -> id;
            $eleves->contact_urgence1=$request['contact_urgence1']; 
            $eleves->contact_urgence2=$request['contact_urgence2']; 
           //$eleves->id_user=$request['id_user'];
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

       // return redirect()->route('eleves.index')->with('success', 'Élève mis à jour avec succès');
    }


   

    public function delete($id)
    {
        $eleve = Eleve::find($id);
        if($eleve!=null){
            $eleve->delete();
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


       // return redirect()->route('eleves.index')->with('success', 'Élève supprimé avec succès');
    }

}
