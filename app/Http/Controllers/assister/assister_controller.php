<?php

namespace App\Http\Controllers\assister;

use App\Http\Controllers\Controller;
use App\Http\Requests\assister\assister_request;
use App\Models\Assister;
use Illuminate\Http\Request;

class assister_controller extends Controller
{
    public function index() {
        $assister=Assister::all();
        if($assister!=null){
            return response()->json([
                'statut'=>200,
                'assister'=>$assister
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(assister_request $request){
        $data=$request->validated();
        $assister=Assister::create($data);
        if($assister!=null){
            return response()->json([
                'statut'=>200,
                'assister'=>$assister
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été éffectué',
            ],500 );
        }
    }
    public function update(assister_request $request, $id){
        $assister=Assister::find($id);
        if($assister!=null){
           $assister->presence=$request['presence'];
           $assister->id_eleve=$request['id_eleve'];
           $assister->id_cour=$request['id_cour'];
          
           $assister->save();
            return response()->json([
                'statut'=>200,
                'assister'=>$assister
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $assister=Assister::find($id);
        if($assister!=null){
            $assister->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'Presence supprimée avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Presence non supprimé',
            ],500 );
        }
       
    }
    
    public function show($id){
        $assister=Assister::find($id);
        if($assister!=null){
            return response()->json([
                'statut'=>200,
                'assister'=>$assister
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La presence n\'a pas été éffectué',
            ],500 );
        }
       
    }
}
