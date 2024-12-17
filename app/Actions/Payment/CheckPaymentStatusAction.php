<?php

namespace App\Actions\Payment;

use Illuminate\Support\Facades\Http;
use App\Models\Transaction;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\Log;

class CheckPaymentStatusAction
{
    /**
     * Vérifier l'état d'un paiement.
     *
     * @param  string  $identifier
     * @return array
     */
    public function execute(string $identifier): array
    {
        // Récupérer la transaction
        $transaction = Transaction::where('transaction_reference', $identifier)->first();
        //return $transaction;
        try {
            //return ["id"  =>  $identifier];

            // Essayer de vérifier avec le tx_reference si disponible
            if ($transaction->transaction_reference) {
                $response = $this->checkByTxReference($transaction->transaction_reference);
            } else {
                // Sinon, vérifier avec l'identificateur
                $response = $this->checkByIdentifier($identifier);
            }

            // Log du résultat de la vérification
            Log::info('Payment Status Check', [
                'identifier' => $identifier,
                'status' => $response['status']->toReadableString(),
                'tx_reference' => $response['tx_reference'] ?? null
            ]);

            return $response;
        } catch (\Exception $e) {
          
            Log::error('Payment Status Check Failed', [
                'identifier' => $identifier,
                'message' => $e->getMessage()
            ]);

            throw $e;
        }
       
    }

    /**
     * Vérifier l'état du paiement par tx_reference
     */
    private function checkByTxReference(string $txReference): array
    {
        $response = Http::post('https://paygateglobal.com/api/v1/status', [
            'auth_token'   => config('services.paygate.auth_token'),
            'tx_reference' => $txReference,
        ]);

        return $this->processResponse($response);
    }

    /**
     * Vérifier l'état du paiement par identifier
     */
    private function checkByIdentifier(string $identifier)//: array
    {
        $response = Http::post('https://paygateglobal.com/api/v2/status', [
            'auth_token'   => config('services.paygate.auth_token'),
            'identifier'   => $identifier,
        ]);
        // return $response;
     return $this->processResponse($response);
    }

    /**
     * Traiter la réponse de l'API
     */
    private function processResponse($response): array
    {
        if ($response->successful()) {
            $data = $response->json();

            // Mapper le statut de Paygate
            $status = TransactionStatus::fromPaygateNumeric($data['status']);

            return [
                'status' => $status,
                'status_text' => $status->toReadableString(),
                'tx_reference' => $data['tx_reference'] ?? null,
                'payment_reference' => $data['payment_reference'] ?? null,
                'datetime' => $data['datetime'] ?? null,
                'raw_response' => $data
            ];
        }

        throw new \Exception('Échec de la vérification du statut de paiement: ' . $response->body());
    }
}