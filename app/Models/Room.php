<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rooms';

    protected $fillable = [
        'roomNumber',
        'roomPhoneNumber',
        'roomPrice',
        'room_category_id', 
        'status',
    ];

    public function photos()
    {
        return $this->morphMany(HotelPhoto::class, 'hotelPhotoable');
    }

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }
}
