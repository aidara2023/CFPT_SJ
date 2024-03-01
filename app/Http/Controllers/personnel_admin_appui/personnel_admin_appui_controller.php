<?php

namespace App\Http\Controllers\personnel_admin_appui;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\personnel_admin_appui\personnel_admin_appui_request;
use App\Models\personnel_admin_appui;
use Illuminate\Http\Request;

class personnel_admin_appui_controller extends Controller
{
    public function index(){
        $personnel_admin_appui = Personnel_admin_appui::orderBy('created_at', 'desc')->get();
        if($personnel_admin_appui != null){
            return response()->json([
                'statut' => 200,
                'personnel_admin_appui' => $personnel_admin_appui,
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée'
            ],500);
        }
    }

    public function store(personnel_admin_appui_request $request) {
        $data = $request -> validated();

        $personnel_admin_appui = Personnel_admin_appui::create($data);
       
        if($personnel_admin_appui != null){
            event(new ModelCreated($personnel_admin_appui));
            return response()->json([
                'statut' => 200,
                'personnel_admin_appui' => $personnel_admin_appui
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué'
            ],500);
        }
    }

    public function update(personnel_admin_appui_request $request, $id) {
        $personnel_admin_appui = Personnel_admin_appui::find($id);
        if($personnel_admin_appui != null){
            $personnel_admin_appui -> id_user = $request['id_user'];
            $personnel_admin_appui -> id_service = $request['id_service'];
            $personnel_admin_appui -> type_personnel = $request['type_personnel'];
            $personnel_admin_appui -> save();
            event(new ModelUpdated($personnel_admin_appui));

            return response()->json([
                'statut' => 200,
                'personnel_admin_appui' => $personnel_admin_appui
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectuée'
            ],500);
        }
    }

    public function delete($id) {
        $personnel_admin_appui = Personnel_admin_appui::find($id);
        if($personnel_admin_appui != null){
            $personnel_admin_appui -> delete();
            event(new ModelDeleted($personnel_admin_appui));
            return response()->json([
                'statut' => 200,
                'message' => 'L\'enregistrement a été supprimé avec succés'
            ],200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été supprimé'
            ],500);
        }
    }

    public function show($id) {
        $personnel_admin_appui = Personnel_admin_appui::find($id);
        if($personnel_admin_appui != null){
            return response()->json([
                'statut' => 200,
                'personnel_admin_appui' => $personnel_admin_appui
            ],200);
        } else{
            return response() -> json([
                'statut' => 500,
                'personnel_admin_appui' => 'Ce personnel n\'existe pas'
            ],500);
        }
    }
}
