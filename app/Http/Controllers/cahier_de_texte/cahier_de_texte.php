<?php

namespace App\Http\Controllers\cahier_de_texte;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\cahier_de_texte\cahier_de_texte as Cahier_de_texteCahier_de_texte;
use App\Models\cahier_de_texte as ModelsCahier_de_texte;
use Illuminate\Http\Request;

class cahier_de_texte extends Controller
{
    public function all() {
        $cahier_de_texte=ModelsCahier_de_texte::with('cour')->orderBy('created_at', 'desc')->get();
        if($cahier_de_texte!=null){
            return response()->json([
                'statut'=>200,
                'cahier_de_texte'=>$cahier_de_texte,
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
    }

    public function all_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $cahier_de_texte=ModelsCahier_de_texte::with('cour',)->orderBy('created_at', 'desc')->paginate($perPage);
        if($cahier_de_texte!=null){
            return response()->json([
                'statut'=>200,
                'cahier_de_texte'=>$cahier_de_texte
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
    }

    public function get_last_value() {
        $cahier_de_texte=ModelsCahier_de_texte::with('cour')->orderBy('created_at', 'desc')->take(5)->get();
        if($cahier_de_texte!=null){
            return response()->json([
                'statut'=>200,
                'cahier_de_texte'=>$cahier_de_texte
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
    }

    public function store(Cahier_de_texteCahier_de_texte $request){
        $data=$request->validated();           

        $verification =ModelsCahier_de_texte::where([['intitule','=', $request['intitule']],['contenu','=', $request['contenu']],['id_cour','=', $request['id_cour']]])->get();

        if($verification->count()!=0){
            return response()->json([
                'statut'=>404,
                'message'=>'Cette cahier_de_texte existe déja',
            ],404 );
        }else{
            $cahier_de_texte=ModelsCahier_de_texte::create($data);
            if($cahier_de_texte!=null){
            event(new ModelCreated($cahier_de_texte));
                return response()->json([
                    'statut'=>200,
                    'cahier_de_texte'=>$cahier_de_texte
                ],200)  ;
            }else{
                return response()->json([
                    'statut'=>500,
                    'message'=>'L\'enregistrement n\'a pas été éffectué',
                ],500 );
            }
        }
    }

    public function update(Cahier_de_texteCahier_de_texte $request, $id){
        $cahier_de_texte=ModelsCahier_de_texte::find($id);
        if($cahier_de_texte!=null){
            $request->validated();
           /* $cahier_de_texte->intitule=$request['intitule']; */
           $cahier_de_texte->intitule=$request['intitule'];
           $cahier_de_texte->contenu=$request['contenu'];
           $cahier_de_texte->id_cour=$request['id_cour'];

           $cahier_de_texte->save();
           event(new ModelUpdated($cahier_de_texte));
            return response()->json([
                'statut'=>200,
                'cahier_de_texte'=>$cahier_de_texte
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }

    public function delete($id){
        $cahier_de_texte=ModelsCahier_de_texte::find($id);
        if($cahier_de_texte!=null){
            $cahier_de_texte->delete();
            event(new ModelDeleted($cahier_de_texte));
            return response()->json([
                'statut'=>200,
                'message'=>'Le cahier_de_textes a été supprimé avec succes',
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Le cahier_de_textes n\'a pas été supprimé',
            ],500 );
        }
    }

    public function show($id){
        $cahier_de_texte=ModelsCahier_de_texte::with('cour')->find($id);
   
        if($cahier_de_texte!=null){
            return response()->json([
                'statut'=>200,
                'cahier_de_texte'=>$cahier_de_texte
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Le cahier_de_textes n\'a pas été trouvé',
            ],500 );
        }
    }
}
