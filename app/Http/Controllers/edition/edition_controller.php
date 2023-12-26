<?php

namespace App\Http\Controllers\edition;

use App\Http\Controllers\Controller;
use App\Http\Requests\edition\edition_request;
use App\Models\Edition;
use Illuminate\Http\Request;

class edition_controller extends Controller
{
    public function index() {
        $edition=Edition::orderBy('created_at', 'desc')->get();
        if($edition!=null){
            return response()->json([
                'statut'=>200,
                'edition'=>$edition
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function store (edition_request $request){
        $data=$request->validated();
        $edition=Edition::create($data);
        if($edition!=null){
            return response()->json([
                'statut'=>200,
                'edition'=>$edition
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'edition n\'a pas été ajouté',
            ],500 );
        }
    }
    public function update(edition_request $request, $id){
        $edition=Edition::find($id);
        if($edition!=null){
           $edition->nom_edition=$request['nom_edition'];
           $edition->id_editeur=$request['id_editeur'];
           $edition->save();
            return response()->json([
                'statut'=>200,
                'edition'=>$edition
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $edition=Edition::find($id);
        if($edition!=null){
            $edition->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'L\'edition supprimé avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'edition n\'est pas été supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $edition=Edition::find($id);
        if($edition!=null){
            return response()->json([
                'statut'=>200,
                'edition'=>$edition
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'edition n\'existe pas ',
            ],500 );
        }
    }
}
