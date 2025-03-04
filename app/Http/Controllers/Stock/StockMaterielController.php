<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockMaterielRequest;
use App\Models\StockMateriel;
use Illuminate\Support\Facades\Log;

class StockMaterielController extends Controller
{
    public function index()
    {
        try {
            Log::info('Début de la récupération des stocks matériels');
            
            $stocks = StockMateriel::with('typeMateriel')
                ->orderBy('created_at', 'desc')
                ->get();
            
            Log::info('Stocks matériels récupérés', ['count' => $stocks->count()]);

            return response()->json([
                'statut' => 200,
                'stocks' => $stocks
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des stocks matériels: ' . $e->getMessage());
            return response()->json([
                'statut' => 500,
                'message' => 'Une erreur est survenue lors de la récupération des stocks',
                'error' => $e->getMessage()
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