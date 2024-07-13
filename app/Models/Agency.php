<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Agency extends User
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
