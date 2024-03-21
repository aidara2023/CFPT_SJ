<?php

namespace App\Http\Controllers\reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\reservation\reservation_request;
use App\Models\Location;
use App\Models\Reservation;
use Illuminate\Http\Request;

class reservation_controller extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('location.partenaire', 'salle')->orderBy('created_at', 'desc')->get();
        if ($reservations->count() > 0) {
            return response()->json([
                'status' => 200,
                'reservation' => $reservations
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Aucune donnée trouvée',
            ], 500);
        }
    }

    public function store(Request $request)
    {
    $reservation= null;

        $location= Location::find($request->id_location);

        if( $location->reserver== 0){

            $location->reserver= true;
            $location->id_salle= $request->id_salle;
            $location->save();

            $reservation = Reservation::create(
                [ 
                 'id_location' => $request->id_location,
                 'date_debut' => $request->date_debut,
                 'date_fin'=> $request->date_fin,
                 'id_salle'=> $request->id_salle
                 ]);

        }
        if (!empty($reservation)) {
            return response()->json([
                'status' => 200,
                'reservation' => $reservation
            ], 200);
        } else {
            return response()->json(
                401,
             );
        }

       
    }

    public function update(reservation_request $request, $id)
    {
        $reservation = reservation::find($id);
        if ($reservation) {
            $data = $request->validate([
                'date_debut' => 'required',
                'date_fin' => 'required',
                'id_salle' => 'required',
                'id_location' => 'required'
            ]);

            $reservation->update($data);

            return response()->json([
                'status' => 200,
                'reservation' => $reservation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'La mise à jour n\'a pas été effectuée',
            ], 500);
        }
    }

    public function delete($id)
    {
        $reservation = reservation::find($id);
        if ($reservation) {
            $reservation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Reservation supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'La reservation n\'a pas été supprimée',
            ], 500);
        }
    }

    public function show($id)
    {
        $reservation = reservation::find($id);
        if ($reservation) {
            return response()->json([
                'status' => 200,
                'reservation' => $reservation
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Le reservation n\'existe pas',
            ], 500);
        }
    }
}
