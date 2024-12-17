<?php

namespace App\Actions\Payment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HandlePaymentConfirmationAction
{
    /**
     * Codes de statut de paiement
     */
    private const STATUS = [
        'SUCCESS' => 1,
        'PENDING' => 2,
        'EXPIRED' => 3, 
        'CANCELLED' => 4
    ];

    /**
     * Traiter la confirmation de paiement.
     *
     * @param  array  $data
     * @return void
     */
    public function execute(array $data): void
    {
        // Validation des données essentielles
        $this->validatePaymentData($data);

        // Log détaillé de la confirmation
        Log::info('Payment Confirmation Received:', [
            'identifier' => $data['identifier'],
            'status' => $data['status'] ?? 'UNKNOWN'
        ]);

        // Déterminer le statut en entier
        $status = $this->mapStatusToInt($data['status'] ?? 'UNKNOWN');

        // Mise à jour de la transaction
        DB::table('transactions')
            ->where('identifier', $data['identifier'])
            ->update([
                'status' => $status,
                'payment_reference' => $data['payment_reference'] ?? null,
                'datetime' => $this->formatDateTime($data['datetime'] ?? now()),
                'updated_at' => now()
            ]);
    }

    /**
     * Valider les données de paiement
     *
     * @param array $data
     * @throws \InvalidArgumentException
     */
    private function validatePaymentData(array $data): void
    {
        if (empty($data['identifier'])) {
            throw new \InvalidArgumentException('Identifiant de transaction manquant');
        }
    }

    /**
     * Mapper le statut texte en entier
     *
     * @param string $status
     * @return int
     */
    private function mapStatusToInt(string $status): int
    {
        // Convertir en majuscules pour la correspondance
        $normalizedStatus = strtoupper($status);

        // Retourner le statut ou un statut par défaut (PENDING)
        return self::STATUS[$normalizedStatus] ?? self::STATUS['PENDING'];
    }

    /**
     * Formater la date et l'heure
     *
     * @param string|\Carbon\Carbon $datetime
     * @return string
     */
    private function formatDateTime($datetime): string
    {
        // Convertir en objet Carbon si ce n'est pas déjà le cas
        $carbonDatetime = $datetime instanceof Carbon 
            ? $datetime 
            : Carbon::parse($datetime);

        return $carbonDatetime->format('Y-m-d H:i:s');
    }
}