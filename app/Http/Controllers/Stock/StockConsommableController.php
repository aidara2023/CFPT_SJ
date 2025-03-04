<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockConsommableRequest;
use App\Models\StockConsommable;

class StockConsommableController extends Controller
{
    public function index()
    {
        $stocks = StockConsommable::orderBy('created_at', 'desc')->get();
        if($stocks != null){
            return response()->json([
                'statut' => 200,
                'stocks' => $stocks
            ], 200);
        }else{
            return response()->json([
                'statut' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(StockConsommableRequest $request)
    {
        $stockConsommable = StockConsommable::create($request->validated());
        return response()->json($stockConsommable, 201);
    }

    public function show($id)
    {
        return StockConsommable::findOrFail($id);
    }

    public function update(StockConsommableRequest $request, $id)
    {
        $stockConsommable = StockConsommable::findOrFail($id);
        $stockConsommable->update($request->validated());
        return response()->json($stockConsommable);
    }

    public function destroy($id)
    {
        $stockConsommable = StockConsommable::findOrFail($id);
        $stockConsommable->delete();
        return response()->json(null, 204);
    }
}