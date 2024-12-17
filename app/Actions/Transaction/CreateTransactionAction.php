<?php

namespace App\Actions\Transaction;

use App\Models\Transaction;
use App\Models\Reservation;
use App\Helpers\TransactionHelper;

class CreateTransactionAction
{
    /**
     * Enregistrer une nouvelle transaction dans la base de données.
     *
     * @param  array  $data
     * @return Transaction
     * @throws \Exception
     */
    public function execute(array $data): Transaction
    {
        // Récupérer la réservation associée
        $reservation = Reservation::find($data['reservation_id']);

        if (!$reservation) {
            throw new \Exception("La réservation spécifiée n'existe pas.");
        }

        // Générer l'identifiant unique
        $identifier = TransactionHelper::generateUniqueIdentifier();

        // Créer la transaction
        return Transaction::create([
            'reservation_id'        => $reservation->id,
            'amount'                => $reservation->amount, 
            'network'               => $data['network'],
            'phone_number'          => $data['phone_number'],
            'identifier'            => $identifier,
            'currency'              => $data['currency'] ?? 'XOF',
            'transaction_date'      => now(),
            'transaction_details'   => $data['transaction_details'] ?? null,
            'status'                => 0,
        ]);
    }
}
