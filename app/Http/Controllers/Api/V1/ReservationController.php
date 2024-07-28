<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Excursion;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::paginate(10);
        return ReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        /*
        $validatedData = $request->validate([
            'excursion_id' => 'required|exists:excursions,id',
        ]);

        // Récupérer l'excursion
        $excursion = Excursion::findOrFail($validatedData['excursion_id']);

        // Vérifier les contraintes, par exemple le nombre de participants
         if ($excursion->reservations()->count() >= $excursion->excursionMaxParticipants) {
            return response()->json([
                'message' => 'No more available spots for this excursion.'
            ], 400);
        }

        // Créer la réservation
        $reservation = new Reservation();
        $reservation->tourist_id = Auth::user()->id; // Assume que le touriste est l'utilisateur connecté
        $reservation->excursion_id = $excursion->id;
        $reservation->status = 'pending'; // Par exemple, en attente de confirmation
        $reservation->save();

        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation,
        ], 201);
        */
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
