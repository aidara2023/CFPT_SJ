<?php

namespace App\Http\Controllers\alerte;

use App\Http\Controllers\Controller;
use App\Http\Requests\alerte\alerte_request;
use App\Models\Alerte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class alerte_controller extends Controller
{
    public function index()
    {
        $alerte = Alerte::orderBy('created_at', 'desc')->get();
        if ($alerte != null) {
            return response()->json([
                'statut' => 200,
                'alerte' => $alerte
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function store(alerte_request $request)
    {
        $data = $request->validated();
        $msg_alerte = Alerte::all();
        if (Auth::user()->role->intitule == "Administrateur") {
            if ($msg_alerte->count() == 0) {

                $alerte = new Alerte();
                $alerte->titre = $request['titre'];
                $alerte->message = $request['message'];
                $alerte->statut = $request['statut'];
                $alerte->id_user = Auth::user()->id;
                $alerte->save();

                return response()->json([
                    'statut' => 200,
                    'alerte' => $alerte
                ], 200);
            } else {
                $alerte = Alerte::latest('created_at')->first();
                $alerte->titre = $request['titre'];
                $alerte->message = $request['message'];
                $alerte->statut = $request['statut'];
                $alerte->id_user = Auth::user()->id;
                $alerte->save();
            }
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été éffectué',
            ], 500);
        }
    }
    public function update(alerte_request $request, $id)
    {
        $alerte = alerte::find($id);

        if ($alerte != null) {
            $alerte->titre = $request['titre'];
            $alerte->message = $request['message'];
            $alerte->statut = $request['statut'];
            $alerte->id_user = $request['id_user'];

            $alerte->save();
            return response()->json([
                'statut' => 200,
                'alerte' => $alerte
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
        $alerte = alerte::find($id);
        if ($alerte != null) {
            $alerte->delete();
            return response()->json([
                'statut' => 200,
                'message' => 'Presence supprimée avec succés',
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Message d alerte  non supprimée',
            ], 500);
        }
    }
    public function showLatestAlert()
{
    $latestAlert = Alerte::orderBy('created_at', 'desc')->first();

    if ($latestAlert != null) {
        return response()->json([
            'statut' => 200,
            'alerte' => $latestAlert
        ], 200);
    } else {
        return response()->json([
            'statut' => 404,
            'message' => 'Aucune alerte trouvée.',
        ], 404);
    }
}

}
