<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\reservation\StoreReservationRequest;
use App\Http\Requests\reservation\UpdateReservationRequest;
use App\Models\Reservation;
use App\Actions\Reservation\CreateReservationAction;
use App\Actions\Reservation\ListReservationsAction;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(
        private ListReservationsAction $listReservationsAction,
        private CreateReservationAction $createReservationAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = $this->listReservationsAction->execute();
        return ReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $reservation = $this->createReservationAction->execute($validatedData);

            return response()->json([
                'message' => 'Reservation created successfully',
                'reservation' => $reservation
            ], 201);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

   
}