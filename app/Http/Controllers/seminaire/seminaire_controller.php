<?php

namespace App\Http\Controllers\seminaire;

use App\Http\Controllers\Controller;
use App\Models\Seminaire;
use Illuminate\Http\Request;

class seminaire_controller extends Controller
{
    public function index() {
        $seminaire=Seminaire::all();
        if($seminaire!=null){
            return response()->json([
                'statut'=>200,
                'seminaire'=>$seminaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,  
                'message'=>'aucun  seminaire  n\'a été enregistrée',
            ],500 );
        }
     }

     public function store (Request $request){
        $data=$request->validate([
            'titre'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
            'description'=>'required',
            'id_direction'=>'required'
                ]);
        $seminaire=Seminaire::create($data);
        if($seminaire!=null){
            return response()->json([
                'statut'=>200,
                'seminaire'=>$seminaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement du seminaire n\'a pas été éffectué',
            ],500 );
        }
    }


    public function update(Request $request, $id){
        $seminaire=Seminaire::find($id);
        if($seminaire!=null){
           $seminaire->titre=$request['titre'];
           $seminaire->date_debut=$request['date_debut'];
           $seminaire->date_fin=$request['date_fin'];
           $seminaire->description=$request['description'];
           $seminaire->id_description=$request['id_description'];
           $seminaire->save();
            return response()->json([
                'statut'=>200,
                'seminaire'=>$seminaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec mise à jour du seminaire',
            ],500 );
        }
    }

    public function delete($id){
        $seminaire=Seminaire::find($id);
        if($seminaire!=null){
            $seminaire->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Le seminaire a été supprimée avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Echec suppression du seminaire',
            ],500 );
        }
       
    }


    public function show($id){
        $seminaire=Seminaire::find($id);
        if($seminaire!=null){
            return response()->json([
                'statut'=>200,
                'seminaire'=>$seminaire
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Ce seminaire n\'existe pas ',
            ],500 );
        }
       
    }
}
