<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class ListReservationsAction
{
    /**
     * Execute the action of listing reservations.
     *
     * @param int $perPage Nombre de réservations par page
     * @return LengthAwarePaginator
     */
    public function execute(int $perPage = 10)
    {
        // Récupérer l'ID de l'utilisateur connecté
        $touristId = Auth::id();

        // Filtrer les réservations de l'utilisateur connecté
        return Reservation::where('tourist_id', $touristId)
            ->paginate($perPage);
    }
}