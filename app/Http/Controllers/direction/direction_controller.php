<?php

namespace App\Http\Controllers\direction;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\direction\direction_request;
use App\Models\Direction;
use Illuminate\Http\Request;

class direction_controller extends Controller
{
    public function index() {
        $direction=Direction::with('user' ,'services')->orderBy('created_at', 'desc')->get();
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function indexpagine(Request $request) {

        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $direction=Direction::with('user' ,'services')->orderBy('created_at', 'desc')->paginate($perPage);
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }
    public function get_five_laste() {
        $direction=Direction::with('user' ,'services')->orderBy('created_at', 'desc')->take(5)->get();
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'aucun enregistrement n\'a été trouvé',
            ],500 );
        }
     }

    public function store(direction_request $request){
        $data=$request->validated();
        $verification =Direction::where('nom_direction', $request['nom_direction'])->get();

        if($verification->count()!=0){
            return response()->json([
                'statut'=>404,
                'message'=>'Cette direction existe déja',
            ],404 );
        }else{
            $direction=Direction::create($data);
            if($direction!=null){
                event(new ModelCreated($direction));
                return response()->json([
                    'statut'=>200,
                    'direction'=>$direction
                ],200)  ;
            }else{
                return response()->json([
                    'statut'=>500,
                    'message'=>'L\'enregistrement n\'a pas été éffectué',
                ],500 );
            }
        }
    }
    public function update(direction_request $request, $id){
        $direction=Direction::find($id);
        if($direction!=null){
           $direction->nom_direction=$request['nom_direction'];
           $direction->id_user=$request['id_user'];
         

           $direction->save();
           event(new ModelUpdated($direction));
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La mise à jour n\'a pas été éffectué',
            ],500 );
        }
    }
    public function delete($id){
        $direction=Direction::find($id);
        if($direction!=null){
            $direction->delete();
            event(new ModelDeleted($direction));
            return response()->json([
                'statut'=>200,
                'message'=>'Direction supprimer avec succes',
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'La direction n\'a pas été supprimé',
            ],500 );
        }

    }

    public function show($id){
        $direction=Direction::find($id);
        if($direction!=null){
            return response()->json([
                'statut'=>200,
                'direction'=>$direction
            ],200)  ;
        }else{
            return response()->json([
                'statut'=>500,
                'message'=>'Direction n\'a pas été éffectué',
            ],500 );
        }

    }
}
