<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TransactionHelper
{
    /**
     * Génère un identifiant unique pour une transaction.
     *
     * @return string
     */
    public static function generateUniqueIdentifier(): string
    {
        // Générer une chaîne unique avec un préfixe spécifique (facultatif)
        $identifier = strtoupper(Str::random(12));

        // Vérifier l'unicité dans la table transactions
        while (self::identifierExists($identifier)) {
            $identifier = strtoupper(Str::random(12)); // Re-générer si déjà existant
        }

        return $identifier;
    }

    /**
     * Vérifie si un identifiant existe déjà dans la base de données.
     *
     * @param string $identifier
     * @return bool
     */
    protected static function identifierExists(string $identifier): bool
    {
        return \App\Models\Transaction::where('identifier', $identifier)->exists();
    }
}
