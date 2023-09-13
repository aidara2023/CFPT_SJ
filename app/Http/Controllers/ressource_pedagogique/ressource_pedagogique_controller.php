<?php

namespace App\Http\Controllers\ressource_pedagogique;

use App\Http\Controllers\Controller;
use App\Models\Ressource_pedagogique;
use Illuminate\Http\Request;

class ressource_pedagogique_controller extends Controller
{
    
    public function index() {
        $ressource_pedagogique=Ressource_pedagogique::all();
        if($ressource_pedagogique!=null){
            return response()->json([
                'statut'=>200,
                'ressource_pedagogique'=>$ressource_pedagogique
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun donné trouvé',
            ],500 );
        }
     }
    public function store (Request $request){
        $data=$request->validate([
            'libelle'=>'required',
            'contenu'=>'required',
            'id_formateur'=>'required',
            'id_eleve'=>'required',
            'id_cour'=>'required',
            'id_unite_de_formation'=>'required'
        ]);
        $ressource_pedagogique=ressource_pedagogique::create($data);
        if($ressource_pedagogique!=null){
            return response()->json([
                'statut'=>200,
                'ressource_pedagogique'=>$ressource_pedagogique
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $ressource_pedagogique=ressource_pedagogique::find($id);
        if($ressource_pedagogique!=null){
           $ressource_pedagogique->titre=$request['titre'];
           $ressource_pedagogique->contenu=$request['contenu'];
           $ressource_pedagogique->id_formateur=$request['id_formateur'];
           $ressource_pedagogique->id_eleve=$request['id_eleve'];
           $ressource_pedagogique->id_unite_de_formation=$request['unite_de_formation'];
           
           $ressource_pedagogique->save();
            return response()->json([
                'statut'=>200,
                'ressource_pedagogique'=>$ressource_pedagogique
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function supprimer($id){
        $ressource_pedagogique=ressource_pedagogique::find($id);
        if($ressource_pedagogique!=null){
            $ressource_pedagogique->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Ressource_pedagogique supprimée avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La ressource_pedagogique n\'est pas supprimée',
            ],500 );
        }
       
    }
    
    public function show($id){
        $ressource_pedagogique=ressource_pedagogique::find($id);
        if($ressource_pedagogique!=null){
            return response()->json([
                'statut'=>200,
                'ressource_pedagogique'=>$ressource_pedagogique
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'ressource_pedagogique n\'existe pas ',
            ],500 );
        }
    }

}
