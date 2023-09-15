<?php

namespace App\Http\Controllers\ressource_pedagogique;

use App\Http\Controllers\Controller;
use App\Http\Requests\ressource_pedagogique\ressource_pedagogique_request;
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
                'message'=>'Aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }
    public function store (ressource_pedagogique_request $request){
        $data=$request->validated();
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
    public function update(ressource_pedagogique_request $request, $id){
        $ressource_pedagogique=ressource_pedagogique::find($id);
        if($ressource_pedagogique!=null){
           $ressource_pedagogique->libelle=$request['libelle'];
           $ressource_pedagogique->contenu=$request['contenu'];
           $ressource_pedagogique->id_formateur=$request['id_formateur'];
           $ressource_pedagogique->id_eleve=$request['id_eleve'];
           $ressource_pedagogique->id_cour=$request['id_cour'];
           $ressource_pedagogique->id_unite_de_formation=$request['id_unite_de_formation'];
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
                'message'=>'ressource_pedagogique supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'ressource_pedagogique non supprimé',
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
                'message'=>'Ce ressource_pedagogique n\'existe pas ',
            ],500 );
        }
    }
}


