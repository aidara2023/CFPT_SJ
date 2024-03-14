<?php

namespace App\Http\Controllers\location;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Models\Partenaire;
use Illuminate\Support\Facades\Auth;

class location_controller extends Controller
{
    public function index() {
        $location=Location::with('partenaire', 'salle', 'user')->orderBy('created_at', 'desc')->get();
        if($location!=null){
            return response()->json([
                'statut'=>200,
                'location'=>$location
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

     public function get_five_laste() {
        $locations = Location::with('partenaire', 'salle', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5) // Ajout de cette ligne pour récupérer les 5 derniers enregistrements
            ->get();
    
        if ($locations->count() > 0) {
            return response()->json([
                'statut' => 200,
                'locat' => $locations
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }
    

    /* public function store(Request $request){
        
        $data=$request->validated();
        if($request['id_partenaire']){
            $partenaire= new Partenaire;
            $partenaire->nom_partenaire= $request->nom_partenaire;
            $partenaire->description= $request->description;
            $partenaire->contact= $request->contact;
            $partenaire->adresse= $request->adresse;
            $partenaire->email= $request->email;
            $partenaire->boite_postale= $request->boite_postale;
            $partenaire->date_debut= $request->date_debut;
            $partenaire->date_fin= $request->date_fin;
            $partenaire->id_direction= $request->id_direction;
            $partenaire->type= $request->type;
            $partenaire->exoneration= $request->exoneration;

            $partenaire->save();

            $location= new Location;
            $location->designation= $request->designation;
            $location->nombre_jour= $request->nombre_jour;
            $location->montant_jour= $request->montant_jour;
            $location->date_location= $request->date_location;
            $location->id_salle= $request->id_salle;
            $location->id_partenaire= $partenaire->id;

            $location->save();


        }else{
            $location=Location::create($data);
        }
       
        if($location!=null){
            event(new ModelCreated($location));
            return response()->json([
                'statut'=>200,
                'service'=>$location
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été ajouté',
            ],500 );
        }
} */

public function store(Request $request) {
  
    if (!$request['id_partenaire']) {
        $partenaire = Partenaire::create([
            'nom_partenaire' => $request->nom_partenaire,
            'description' => $request->description,
            'contact'=> $request->contact,
            'adresse'=> $request->adresse,
            'email'=> $request->email,
            'boite_postale'=> $request->boite_postale,
            'date_debut'=> $request->date_debut,
            'date_fin'=> $request->date_fin,
            'id_direction'=> $request->id_direction,
            'type'=> $request->type,
            'exoneration'=> $request->exoneration,
        ]);

        $location = Location::create([
            'designation' => $request->designation,
            'nombre_jour' => $request->nombre_jour,
            'montant_jour'=> $request->montant_jour,
            'date_location'=> $request->date_location,
            'id_salle'=> $request->id_salle,
            'id_partenaire' => $partenaire->id,
        ]);
    } else {
        $location = Location::create([
            'designation' => $request->designation,
            'nombre_jour' => $request->nombre_jour,
            'montant_jour'=> $request->montant_jour,
            'date_location'=> $request->date_location,
            'id_salle'=> $request->id_salle,
            'id_partenaire' => $request->id_partenaire,
        ]);
    }

    if ($location->exists) {
        event(new ModelCreated($location));
        return response()->json([
            'status' => 200,
            'service' => $location
        ], 200);
    } else {
        return response()->json([
            'status' => 500,
            'message' => 'L\'enregistrement n\'a pas été ajouté',
        ], 500);
    }
}

    public function update(Request $request, $id){
        $location=Location::find($id);
        if($location!=null){
           $location->designation=$request['designation'];
           $location->nombre_jour=$request['nombre_jour'];
           $location->montant_jour=$request['montant_jour'];
           $location->date_location=$request['date_location'];
           $location->id_partenaire=$request['id_partenaire'];
           $location->id_salle=$request['id_salle'];
           $location->id_user=Auth::user()->id;
          
           $location->save();
           event(new ModelUpdated($location));
            return response()->json([
                'statut'=>200,
                'service'=>$location
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $location=Location::find($id);
        if($location!=null){
            $location->delete();
            event(new ModelDeleted($location));
            return response()->json([
                'statut'=>200,
                'message'=>'Location supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La location n\'est pas supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $location=Location::find($id);
        if($location!=null){
            return response()->json([
                'statut'=>200,
                'location'=>$location
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Location non enregistré',
            ],500 );
        }
       
    }
}
