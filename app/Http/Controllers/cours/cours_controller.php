<?php

namespace App\Http\Controllers\cours;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\cours\cours_request;
use App\Models\Cour;
use Illuminate\Http\Request;

class cours_controller extends Controller
{
    public function all()
    {
        $cour = Cour::with('Classe', 'Formateur.user', 'Matiere', 'annee', 'Semestre')->orderBy('created_at', 'desc')->get();
        if ($cour != null) {
            return response()->json([
                'statut' => 200,
                'cour' => $cour,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function all_paginate(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $cour = Cour::with('classe', 'formateur.user', 'matiere', 'annee', 'semestre')->orderBy('created_at', 'desc')->paginate($perPage);
        if ($cour != null) {
            return response()->json([
                'statut' => 200,
                'cour' => $cour
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function get_last_value()
    {
        $cour = Cour::with('classe', 'formateur.user', 'matiere', 'annee', 'semestre')->orderBy('created_at', 'desc')->take(5)->get();
        if ($cour != null) {
            return response()->json([
                'statut' => 200,
                'cour' => $cour
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function store(cours_request $request)
    {
        $data = $request->validated();

        /*         $verification =cour::where([['intitule','=', $request['intitule']],['date_cour','=', $request['date_cour']],['id_formateur','=', $request['id_formateur']]])->get();
 */
        $verification = cour::where([['id_classe', '=', $request['id_classe']], ['id_formateur', '=', $request['id_formateur']],  ['id_matiere', '=', $request['id_matiere']],  ['id_annee_academique', '=', $request['id_annee_academique']],  ['id_semestre', '=', $request['id_semestre']]])->get();

        if ($verification->count() != 0) {
            return response()->json([
                'statut' => 404,
                'message' => 'Ce cours existe deja',
            ], 404);
        } else {
            $cour = cour::create($data);
            if ($cour != null) {
                event(new ModelCreated($cour));
                return response()->json([
                    'statut' => 200,
                    'cour' => $cour
                ], 200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'L\'enregistrement n\'a pas été éffectué',
                ], 500);
            }
        }
    }

    public function update(cours_request $request, $id)
    {
        $cour = cour::find($id);
        if ($cour != null) {
            $request->validated();
            /* $cour->intitule=$request['intitule']; */
           /*  $cour->heure_debut = $request['heure_debut'];
            $cour->heure_fin = $request['heure_fin']; */
            $cour->id_formateur = $request['id_formateur'];
            $cour->id_classe = $request['id_classe'];
            $cour->id_annee_academique = $request['id_annee_academique'];
            $cour->id_matiere = $request['id_matiere'];
            $cour->id_semestre = $request['id_semestre'];

            $cour->save();
            event(new ModelUpdated($cour));
            return response()->json([
                'statut' => 200,
                'cour' => $cour
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été éffectué',
            ], 500);
        }
    }

    public function delete($id)
    {
        $cour = cour::find($id);
        if ($cour != null) {
            $cour->delete();
            event(new ModelDeleted($cour));
            return response()->json([
                'statut' => 200,
                'message' => 'Le cours a été supprimé avec succes',
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Le cours n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $cour = cour::with('classe', 'formateur', 'matiere', 'annee', 'semestre')->find($id);

        if ($cour != null) {
            return response()->json([
                'statut' => 200,
                'cour' => $cour
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Le cours n\'a pas été trouvé',
            ], 500);
        }
    }
}
