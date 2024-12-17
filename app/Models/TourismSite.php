<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class TourismSite extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tourims_sites';

    protected $fillable = [
        'tourismeSiteName',
        'tourismeSiteCity',
        'tourismeSiteDescription',
        'tourismeSiteEnterPrice',
        'tourismeSiteWebSite',
        'tourismeSitePhoneNumber',
        'latitude',
        'longitude',
        'status',
        'rating',
        'opening_time',
        'closing_time',
        'tourism_category_id',
    ];    

    protected $casts = [
        'tourismeSiteEnterPrice' => 'float',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'status' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mainPhoto()
    {
        return $this->photos()->where('is_main', true)->first();
    }

    public function excursions()
    {
        return $this->hasMany(Excursion::class);
    }

    public function category()
    {
        return $this->belongsTo(TourismCategory::class, 'category_id');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}
