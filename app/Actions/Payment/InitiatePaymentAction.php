<?php

namespace App\Actions\Payment;

use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InitiatePaymentAction
{
    public function execute(array $data): array
    {
        try {
            $response = Http::post('https://paygateglobal.com/api/v1/pay', [
                'auth_token'    => config('services.paygate.auth_token'),
                'phone_number'  => $data['phone_number'],
                'amount'        => $data['amount'],
                'description'   => $data['description'] ?? '',
                'identifier'    => $data['identifier'],
                'network'       => $data['network'],
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                // Mapper le statut Paygate en statut de transaction
                $status = TransactionStatus::fromPaygateNumeric($responseData['status']);

                // Log de l'initiation de paiement
                Log::info('Payment Initiation', [
                    'identifier' => $data['identifier'],
                    'status' => $status->toReadableString(),
                    'tx_reference' => $responseData['tx_reference'] ?? null
                ]);

                return [
                    'status' => $status,
                    'status_text' => $status->toReadableString(),
                    'tx_reference' => $responseData['tx_reference'] ?? null,
                    'raw_response' => $responseData
                ];
            }

            // Gestion des erreurs HTTP
            Log::error('Payment Initiation Failed', [
                'identifier' => $data['identifier'],
                'response' => $response->body()
            ]);

            throw new \Exception('Échec de l\'initiation du paiement: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Payment Initiation Exception', [
                'message' => $e->getMessage(),
                'identifier' => $data['identifier']
            ]);

            throw $e;
        }
    }
}