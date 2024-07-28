<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'startDate',
        'endDate',
        'reservable_type',
        'reservable_id',
        'tourist_id',
        'status',
    ];

    protected $dates = [
        'startDate',
        'endDate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reservable()
    {
        return $this->morphTo();
    }

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }
}
