<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'amount',
        'network',
        'phone_number',
        'identifier',
        'transaction_date',
        'transaction_reference',
        'currency',
        'transaction_details',
        'status',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class); 
    }

    public function tourist()
    {
        return $this->belongsToThrough(Tourist::class, Reservation::class); 
    }
}
