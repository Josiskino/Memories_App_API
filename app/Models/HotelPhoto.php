<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotel_photo';

    protected $fillable = [
        'is_main',
        'hotelPhotoUrl',
        'hotelPhotoable_id',
        'hotelPhotoable_type',
        'status',
    ];

    public function hotelPhotoable()
    {
        return $this->morphTo();
    }
}
