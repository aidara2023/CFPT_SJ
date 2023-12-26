<?php

namespace App\Http\Controllers\archive;

use App\Http\Controllers\Controller;
use App\Http\Requests\archive\archive_request;
use App\Models\Archive;
use Illuminate\Http\Request;

class archive_controller extends Controller
{
    public function index() {
        $archive=Archive::orderBy('created_at', 'desc')->get();
        if($archive!=null){
            return response()->json([
                'statut'=>200,
                'archive'=>$archive
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(archive_request $request){
        $data=$request->validated();
        $archive=Archive::create($data);
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
    public function update(archive_request $request, $id){
        $archive=Archive::find($id);
        if($archive!=null){
           $archive->titre=$request['titre'];
           $archive->type=$request['type'];
           $archive->statut=$request['statut'];
           $archive->date_destruction=$request['date_destruction'];
           $archive->contenu=$request['contenu'];
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
    public function delete($id){
        $archive=Archive::find($id);
        if($archive!=null){
            $archive->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Archive supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'archive n\'a pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $archive=Archive::find($id);
        if($archive!=null){
            return response()->json([
                'statut'=>200,
                'archive'=>$archive
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Archive n\'a pas été trouvé',
            ],500 );
        }
       
    }
}
