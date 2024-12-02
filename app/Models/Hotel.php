<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hotelName',
        'hotelCity',
        'hotelEmail',
        'hotelPhone',
        'latitude',
        'longitude',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'status' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function photos()
    {
        return $this->morphMany(HotelPhoto::class, 'hotelPhotoable');
    }

    public function roomCategories()
    {
        return $this->hasMany(RoomCategory::class);
    }
}
