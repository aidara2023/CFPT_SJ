<?php

namespace App\Http\Controllers\categorie;

use App\Http\Controllers\Controller;
use App\Http\Requests\categorie\categorie_request;
use App\Models\Categorie;
use Illuminate\Http\Request;

class categorie_controller extends Controller
{
    
    public function index() {
        $categorie=Categorie::orderBy('created_at', 'desc')->get();
        if($categorie!=null){
            return response()->json([
                'statut'=>200,
                'categorie'=>$categorie
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
     public function get_five_laste(){
        $categorie = Categorie::with('livre')->orderBy('created_at', 'desc')->take(5)->get();
        if($categorie != null){
            return response()->json([
                'statut' => 200,
                'categorie' => $categorie
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé'
            ],500);
        }
    }
     


    public function store (categorie_request $request){
        $data=$request->validated();
        $verification =Categorie::where('intitule', $request['intitule'])->get();
        if($verification->count()!=0){
            return response()->json([
                'statut'=>404,
                'message'=>'Cette categorie existe déja',
            ],404 );
        }else{
            $categorie=Categorie::create($data);
            if($categorie!=null){
                return response()->json([
            'statut'=>200,
                    'categorie'=>$categorie
                ],200)  ;
            }else{
                return response()->json([
                    'statut'=>500,
                    'message'=>'L\'enregistrement n\'a pas été éffectué',
                ],500 );
            }
        }
    }
    


    public function update(categorie_request $request, $id){
        $categorie=Categorie::find($id);
        if($categorie!=null){
            $request->validated();
           $categorie->intitule=$request['intitule'];
           
           $categorie->save();
            return response()->json([
                'statut'=>200,
                'categorie'=>$categorie
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectuée',
            ],500 );
        }
    }
    public function delete($id){
        $categorie=categorie::find($id);
        if($categorie!=null){
            $categorie->delete();
            return response()->json([
                'statut'=>200,
                'message'=>'categorie supprimée avec succés',
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'La categorie n\'est pas supprimée',
            ],500 );
        }
       
    }
    
    public function show($id){
        $categorie=categorie::find($id);
        if($categorie!=null){
            return response()->json([
                'statut'=>200,
                'categorie'=>$categorie
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'L\'categorie n\'existe pas ',
            ],500 );
        }
    }

}
