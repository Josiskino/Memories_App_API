<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Tourist extends Model
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'touristName',
        'touristUserName',
        'touristPhone',
        'touristAddress',
        'touristCity',
        'touristCountry',
        'touristPostalCode',
        'touristPassport',
        'touristPassportCountry',
        'touristPassportDate',
        'touristPassportNumber',
        'touristPassportExpiry',
        'touristPassportIssue',
        'touristPassportPlace',
        'touristPassportType',
        'touristPassportImage',
        'status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
