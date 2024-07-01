<?php

namespace App\Http\Controllers\emploi_du_temps;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\emploi_du_temps\emploi_du_temps_request;
use App\Http\Requests\EmploiDuTempsRequest;
use App\Models\emploi_du_temps;
use Illuminate\Http\Request;
use App\Models\EmploiDuTemps;

class emploi_du_temps_controller extends Controller
{
    public function all() {
        $emploiDuTemps = Emploi_du_temps::with('cour', 'anne_academique')->orderBy('created_at', 'desc')->get();
        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function all_paginate(Request $request) {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $emploiDuTemps = Emploi_du_temps::with('classe', 'formateur.user', 'matiere', 'salle', 'semestre')->orderBy('created_at', 'desc')->paginate($perPage);
        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function get_last_value() {
        $emploiDuTemps = Emploi_du_temps::with('classe', 'formateur.user', 'matiere', 'salle', 'semestre')->orderBy('created_at', 'desc')->take(5)->get();
        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function store(emploi_du_temps_request $request) {
        $data = $request->validated();

        $verification = Emploi_du_temps::where([
            ['date_debut', '=', $request['date_debut']],
            ['date_fin', '=', $request['date_fin']],
            ['id_cour', '=', $request['id_cour']],
            ['id_anne_academique', '=', $request['id_anne_academique']]
        ])->get();

        if ($verification->count() != 0) {
            return response()->json([
                'statut' => 404,
                'message' => 'Cet emploi du temps existe déjà',
            ], 404);
        } else {
            $emploiDuTemps = Emploi_du_temps::create($data);
            if ($emploiDuTemps != null) {
                event(new ModelCreated($emploiDuTemps));
                return response()->json([
                    'statut' => 200,
                    'emploi_du_temps' => $emploiDuTemps,
                ], 200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'L\'enregistrement n\'a pas été effectué',
                ], 500);
            }
        }
    }

    public function update(emploi_du_temps_request $request, $id) {
        $emploiDuTemps = Emploi_du_temps::find($id);
        if ($emploiDuTemps != null) {
            $request->validated();
            $emploiDuTemps->date_debut = $request['date_debut'];
            $emploiDuTemps->date_fin = $request['date_fin'];
            $emploiDuTemps->id_cour = $request['id_cour'];
            $emploiDuTemps->id_annee_academique = $request['id_annee_academique'];
            
            $emploiDuTemps->save();
            event(new ModelUpdated($emploiDuTemps));
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été effectuée',
            ], 500);
        }
    }

    public function delete($id) {
        $emploiDuTemps = emploi_du_temps::find($id);
        if ($emploiDuTemps != null) {
            $emploiDuTemps->delete();
            event(new ModelDeleted($emploiDuTemps));
            return response()->json([
                'statut' => 200,
                'message' => 'L\'emploi du temps a été supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'emploi du temps n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id) {
        $emploiDuTemps = emploi_du_temps::with('classe', 'formateur.user', 'matiere', 'salle', 'semestre')->find($id);

        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'emploi du temps n\'a pas été trouvé',
            ], 500);
        }
    }
}
