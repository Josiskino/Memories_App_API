<?php

namespace App\Actions\Transaction;

use App\Models\Transaction;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\Log;

class UpdateTransactionStatusAction
{
    /**
     * Mettre à jour l'état d'une transaction.
     *
     * @param  string  $identifier
     * @param  TransactionStatus  $status
     * @param  string|null  $reference
     * @return Transaction
     */
    public function execute(string $identifier, TransactionStatus $status, ?string $reference = null): Transaction
    {
        // Validation des paramètres
        if (empty($identifier)) {
            throw new \InvalidArgumentException('L\'identifiant de la transaction est manquant.');
        }

        // Rechercher la transaction
        $transaction = Transaction::where('transaction_reference', $identifier)->firstOrFail();

        // Log de la mise à jour
        Log::info('Transaction Status Update', [
            'identifier' => $identifier,
            'old_status' => $transaction->status,
            'new_status' => $status->toReadableString(),
            'reference' => $reference
        ]);

        // Mettre à jour la transaction
        $transaction->update([
            'status' => $status->value,
            'transaction_reference' => $identifier,
            'updated_at' => now()
        ]);

        return $transaction;
    }
}