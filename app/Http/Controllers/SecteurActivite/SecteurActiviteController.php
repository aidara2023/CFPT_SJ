<?php

namespace App\Http\Controllers\SecteurActivite;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecteurActivite\SecteurActiviteRequest;
use App\Models\SecteurActivite;

class SecteurActiviteController extends Controller
{
   
    public function index()
    {
        $secteurs=SecteurActivite::orderBy('created_at', 'desc')->get();
        if($secteurs!=null){
            return response()->json([
                'statut'=>200,
                'secteurs' => $secteurs
            ],200);
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
    }

    public function store(SecteurActiviteRequest $request)
    {
        $secteurActivite = SecteurActivite::create($request->validated());
        return response()->json($secteurActivite, 201);
    }

    public function show($id)
    {
        return SecteurActivite::findOrFail($id);
    }

    public function update(SecteurActiviteRequest $request, $id)
    {
        $secteurActivite = SecteurActivite::findOrFail($id);
        $secteurActivite->update($request->validated());
        return response()->json($secteurActivite);
    }

    public function destroy($id)
    {
        $secteurActivite = SecteurActivite::findOrFail($id);
        $secteurActivite->delete();
        return response()->json(null, 204);
    }
}