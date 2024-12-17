<?php

namespace App\Enums;

enum TransactionStatus: int
{
    case UNKNOWN = 0;
    case SUCCESS = 1;
    case PENDING = 2;
    case EXPIRED = 3;
    case CANCELLED = 4;

    case PAYMENT_FAILED = 5;
    case PAYMENT_PENDING = 6;
    case PAYMENT_SUCCESS = 7;
    case PAYMENT_PAID = 8;

    /**
     * Convertit un statut Paygate (numérique) en statut de transaction
     */
    public static function fromPaygateNumeric(int $status): self
    {
        return match ($status) {
            0 => self::SUCCESS,
            2 => self::PENDING,
            4 => self::EXPIRED,
            6 => self::CANCELLED,
            default => self::UNKNOWN
        };
    }

    /**
     * Convertit un statut Paygate (texte) en statut de transaction
     */
    public static function fromPaygateText(string $status): self
    {
        return match (strtolower($status)) {
            'success' => self::SUCCESS,
            'pending' => self::PENDING,
            'expired' => self::EXPIRED,
            'cancelled' => self::CANCELLED,
            default => self::UNKNOWN
        };
    }

    /**
     * Convertit le statut en chaîne lisible
     */
    public function toReadableString(): string
    {
        return match ($this) {
            self::UNKNOWN => 'Inconnu',
            self::SUCCESS => 'Succès',
            self::PENDING => 'En cours',
            self::EXPIRED => 'Expiré',
            self::CANCELLED => 'Annulé'
        };
    }
}