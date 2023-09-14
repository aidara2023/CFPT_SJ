<?php

namespace App\Http\Controllers\archive;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Http\Request;

class archive_controller extends Controller
{
    public function index() {
        $archive=Archive::all();
        if($archive!=null){
            return response()->json([
                'statut'=>200,
                'archive'=>$archive
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été éffectué',
            ],500 );
        }
     }

    public function store(Request $request){
        $data=$request->validate([
            'titre'=>'required',
            'type'=>'required',
            'statut'=>'required',
            'date_destruction'=>'required',
            'contenu'=>'required',
            'id_departement'=>'required',
            'id_service'=>'required'
           
        ]);
        $archive=archive::create($data);
        if($archive!=null){
            return response()->json([
                'statut'=>200,
                'archive'=>$archive
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(Request $request, $id){
        $archive=archive::find($id);
        if($archive!=null){
           $archive->titre=$request['titre'];
           $archive->type=$request['type'];
           $archive->statut=$request['id_statut'];
           $archive->date_destruction=$request['id_date_destruction'];
           $archive->contenu=$request['id_contenu'];
           $archive->id_departement=$request['id_departement'];
           $archive->id_service=$request['id_service'];
          
           $archive->save();
            return response()->json([
                'statut'=>200,
                'archive'=>$archive
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function supprimer($id){
        $archive=archive::find($id);
        if($archive!=null){
            $archive->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'archive supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La archive n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $archive=archive::find($id);
        if($archive!=null){
            return response()->json([
                'statut'=>200,
                'archive'=>$archive
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'archive n\'a pas été éffectué',
            ],500 );
        }
       
    }
}
