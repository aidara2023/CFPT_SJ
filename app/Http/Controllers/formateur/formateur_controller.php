<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Http\Requests\formateur\formateur_request;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Http\Request;

class formateur_controller extends Controller
{
    public function index() {
        $formateur=Formateur::all();
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }

    public function store (formateur_request $request){
        $data=$request->validated();
        $user=User::create($data);
        $formateur=Formateur::create([
            'type'=>$request->type,
            'situation_matrimoniale'=>$request->situation_matrimoniale,
            'id_specialite'=>$request->id_specialite,
            'id_departement'=>$request->id_departement,
            'id_user'=>$user->id
        ]);
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(formateur_request $request, $id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
           $formateur->type=$request['type'];
           $formateur->situation_matrimoniale=$request['situation_matrimoniale'];
           $formateur->id_specialite=$request['id_specialite'];
           $formateur->id_departement=$request['id_departement'];
           $formateur->id_user=$request['id_user'];
          
           $formateur->save();
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
            $formateur->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Formateur supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le formateur n\'est pas supprimer',
            ],500 );
        }
       
    }
    
    public function show($id){
        $formateur=Formateur::find($id);
        if($formateur!=null){
            return response()->json([
                'statut'=>200,
                'formateur'=>$formateur
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Le formateur n\'existe pas',
            ],500 );
        }
       
    }
}
