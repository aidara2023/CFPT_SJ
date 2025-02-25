<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Materiel;
use App\Models\Consommable;
use App\Models\Dispatching;
use App\Models\DemandeConsommable;
use App\Models\DemandeMateriel;
use App\Models\Demande;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $source = $request->input('source');
            $type = $request->input('type');

            // Log des paramètres reçus
            Log::info("Paramètres de recherche:", [
                'source' => $source,
                'type' => $type,
                'perPage' => $perPage
            ]);

            // Récupérer les dispatchings de matériels
            $materielsQuery = Dispatching::query()
                ->join('materiels', 'dispatchings.id_materiel', '=', 'materiels.id')
                ->join('departements', 'materiels.id_departement', '=', 'departements.id')
                ->join('users', 'dispatchings.id_user', '=', 'users.id')
                ->whereNotNull('dispatchings.id_materiel')
                ->select(
                    'dispatchings.created_at as date_entree',
                    'materiels.libelle',
                    'dispatchings.quantite',
                    'materiels.source',
                    DB::raw("'materiel' as type"),
                    'departements.nom_departement',
                    'users.nom',
                    'users.prenom'
                );

            // Récupérer les dispatchings de consommables
            $consommablesQuery = Dispatching::query()
                ->join('consommables', 'dispatchings.id_consommable', '=', 'consommables.id')
                ->join('departements', 'consommables.id_departement', '=', 'departements.id')
                ->join('users', 'dispatchings.id_user', '=', 'users.id')
                ->whereNotNull('dispatchings.id_consommable')
                ->select(
                    'dispatchings.created_at as date_entree',
                    'consommables.libelle',
                    'dispatchings.quantite',
                    'consommables.source',
                    DB::raw("'consommable' as type"),
                    'departements.nom_departement',
                    'users.nom',
                    'users.prenom'
                );

            // Appliquer les filtres
            if ($source) {
                $materielsQuery->where('materiels.source', '=', $source);
                $consommablesQuery->where('consommables.source', '=', $source);
            }

            // Log des requêtes avant l'union
            Log::info("Requête matériels:", ['sql' => $materielsQuery->toSql()]);
            Log::info("Requête consommables:", ['sql' => $consommablesQuery->toSql()]);

            if ($type === 'materiel') {
                $transactions = $materielsQuery->orderBy('date_entree', 'desc')->paginate($perPage);
            } elseif ($type === 'consommable') {
                $transactions = $consommablesQuery->orderBy('date_entree', 'desc')->paginate($perPage);
            } else {
                // Union des deux requêtes
                $transactions = $materielsQuery->union($consommablesQuery)
                    ->orderBy('date_entree', 'desc')
                    ->paginate($perPage);
            }

            // Log du résultat
            Log::info("Nombre de transactions trouvées:", ['count' => $transactions->count()]);

            return response()->json($transactions);

        } catch (\Exception $e) {
            Log::error("Erreur lors de la récupération des transactions:", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Erreur lors de la récupération des transactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}