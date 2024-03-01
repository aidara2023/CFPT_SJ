<?php

namespace App\Http\Controllers\exemplaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\exemplaire\exemplaire_request;
use App\Models\Exemplaire;
use Illuminate\Http\Request;

class exemplaire_controller extends Controller
{
    
    public function index() {
        $exemplaire=Exemplaire::with('livre', 'rayon')->orderBy('created_at', 'desc')->get();
        if($exemplaire!=null){
            return response()->json([
                'statut'=>200,
                'exemplaire'=>$exemplaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
     public function get_five_laste() {
        $exemplaires = Exemplaire::with('user', 'direction')
            ->orderBy('created_at', 'desc')
            ->take(5) // Ajout de cette ligne pour récupérer les 5 derniers enregistrements
            ->get();
    
        if ($exemplaires->count() > 0) {
            return response()->json([
                'statut' => 200,
                'exemplaire' => $exemplaires
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }


    public function store (exemplaire_request $request){
        $data=$request->validated();
        $verification =Exemplaire::where('intitule', $request['intitule'])->get();
        if($verification->count()!=0){
            return response()->json([ 
                'statut'=>404,
                'message'=>'Ce exemplaire existe déja',
            ],404 );
        }else{
        $exemplaire=Exemplaire::create($data);
        if($exemplaire!=null){
            return response()->json([
                'statut'=>200,
                'exemplaire'=>$exemplaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été ajouté',
            ],500 );
        }
    }
}

    public function update(exemplaire_request $request, $id){
        $exemplaire=Exemplaire::find($id);
        if($exemplaire!=null){
           $exemplaire->intitule=$request['intitule'];
           $exemplaire->id_livre=$request['id_livre'];
           $exemplaire->id_rayon=$request['id_rayon'];
           $exemplaire->save();
            return response()->json([
                'statut'=>200,
                'exemplaire'=>$exemplaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function delete($id){
        $exemplaire=exemplaire::find($id);
        if($exemplaire!=null){
            $exemplaire->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'exemplaire supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'exemplaire n\'est pas supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $exemplaire=exemplaire::find($id);
        if($exemplaire!=null){
            return response()->json([
                'statut'=>200,
                'exemplaire'=>$exemplaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'exemplaire n\'existe pas ',
            ],500 );
        }
    } 
}
