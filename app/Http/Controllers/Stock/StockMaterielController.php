<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockMaterielRequest;
use App\Models\StockMateriel;

class StockMaterielController extends Controller
{
    public function index()
    {
        $stocks = StockMateriel::with('typeMateriel')->orderBy('created_at', 'desc')->get(); // Incluez la relation
        if ($stocks != null) {
            return response()->json([
                'statut' => 200,
                'stocks' => $stocks
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(StockMaterielRequest $request)
    {
        $stockMateriel = StockMateriel::create($request->validated());
        return response()->json($stockMateriel, 201);
    }

    public function show($id)
    {
        return StockMateriel::findOrFail($id);
    }

    public function update(StockMaterielRequest $request, $id)
    {
        $stockMateriel = StockMateriel::findOrFail($id);
        $stockMateriel->update($request->validated());
        return response()->json($stockMateriel);
    }

    public function destroy($id)
    {
        $stockMateriel = StockMateriel::findOrFail($id);
        $stockMateriel->delete();
        return response()->json(null, 204);
    }
}