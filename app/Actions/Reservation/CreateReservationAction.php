<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CreateReservationAction
{
    /**
     * Execute the action of creating a reservation.
     *
     * @param array $data
     * @return Reservation
     */
    public function execute(array $data)
    {
        // Mapper les types simplifiés vers leurs namespaces complets
        $reservableTypes = [
            'tourism_site' => 'App\\Models\\TourismSite',
            'hotel' => 'App\\Models\\Hotel',
        ];

        if (!isset($reservableTypes[$data['reservable_type']])) {
            throw new \InvalidArgumentException('Invalid reservable type');
        }

        // Récupérer l'ID de l'utilisateur connecté
        $touristId = Auth::id();

        return Reservation::create([
            'startDate' => $data['startDate'],
            'endDate' => $data['endDate'],
            'amount' => $data['amount'],
            'reservable_type' => $reservableTypes[$data['reservable_type']],
            'reservable_id' => $data['reservable_id'],
            'tourist_id' => $touristId, 
            'status' => $data['status'] ?? 0,
            'reservationTime' => $data['reservationTime'] ?? null,
        ]);
    }
}