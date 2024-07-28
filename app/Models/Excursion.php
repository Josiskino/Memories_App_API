<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excursion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'excursionName',
        'excursionDescription',
        'excursionDate',
        'excursionTime',
        'excursionPlace',
        'excursionPrice',
        'excursionMaxParticipants',
        'status',
        'agency_id',
        'tourism_site_id',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function participants()
    {
        return $this->hasMany(Participation::class);
    }

    public function tourismSite()
    {
        return $this->belongsTo(TourismSite::class, 'tourism_site_id');
    }
}
