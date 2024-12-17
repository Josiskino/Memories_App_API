<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\transaction\StoreTransactionRequest;
use App\Actions\Payment\InitiatePaymentAction;
use App\Actions\Payment\CheckPaymentStatusAction;
use App\Actions\Transaction\CreateTransactionAction;
use App\Actions\Transaction\UpdateTransactionStatusAction;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function initiatePayment(
        StoreTransactionRequest $request,
        CreateTransactionAction $createTransactionAction,
        InitiatePaymentAction $initiatePaymentAction
    ) {
        // Validation des données
        $validated = $request->validated();

        // Commencer une transaction de base de données
        return DB::transaction(function () use ($validated, $createTransactionAction, $initiatePaymentAction) {
            try {
                // 1. Créer une transaction en base de données
                $transaction = $createTransactionAction->execute([
                    'reservation_id' => $validated['reservation_id'],
                    'network' => $validated['network'],
                    'phone_number' => $validated['phone_number'],
                    'currency' => 'XOF'
                ]);

                // 2. Initier le paiement via Paygate
                $paymentResult = $initiatePaymentAction->execute([
                    'phone_number' => $transaction->phone_number,
                    'amount' => $transaction->amount,
                    'network' => $transaction->network,
                    'identifier' => $transaction->identifier,
                    'description' => "Paiement pour réservation #{$transaction->reservation_id}"
                ]);

                // 3. Mettre à jour la transaction
                $transaction->update([
                    'status' => $paymentResult['status']->value,
                    'transaction_reference' => $paymentResult['tx_reference'] ?? null
                ]);

                return response()->json([
                    'message' => 'Transaction initiée avec succès',
                    'transaction' => $transaction,
                    'payment_details' => $paymentResult
                ]);
            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'initiation du paiement', [
                    'message' => $e->getMessage(),
                    'reservation_id' => $validated['reservation_id'] ?? null
                ]);

                return response()->json([
                    'error' => 'Échec de l\'initiation du paiement',
                    'details' => $e->getMessage()
                ], 500);
            }
        });
    }

    public function checkPaymentStatus(
        Request $request,
        CheckPaymentStatusAction $checkPaymentStatusAction,
        UpdateTransactionStatusAction $updateTransactionStatusAction
    ) {
        $request->validate([
            'identifier' => 'required|string'
        ]);
     
        try {
            //return $request->all();

            // Vérifier le statut du paiement
            $paymentStatus = $checkPaymentStatusAction->execute($request->identifier);

            // return response()->json([
            //     'error' => 'Impossible de vérifier le statut du paiement',
               
            // ], 500);
            // return $paymentStatus;

            // Mettre à jour le statut de la transaction
            $transaction = $updateTransactionStatusAction->execute(
                $request->identifier, 
                $paymentStatus['status'],
                $paymentStatus['tx_reference']
            );

            //Logique supplémentaire en fonction du statut

            if ($paymentStatus['status'] === TransactionStatus::SUCCESS) {
                $transaction->reservation->update(['status' => TransactionStatus::PAYMENT_SUCCESS]);
            } else if (in_array($paymentStatus['status'], [
                TransactionStatus::EXPIRED, 
                TransactionStatus::CANCELLED
            ])) {
                $transaction->reservation->update(['status' => TransactionStatus::PAYMENT_FAILED]);
            }

            //$transaction->reservation->update(['status' => $paymentStatus['status']]);

            return response()->json([
                'transaction' => $transaction,
                'payment_status' => $paymentStatus
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la vérification du statut', [
                'identifier' => $request->identifier,
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Impossible de vérifier le statut du paiement',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}