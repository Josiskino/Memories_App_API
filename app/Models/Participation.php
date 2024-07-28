<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'excursion_id', 
        'tourist_id', 
        'status',
    ];

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }

    public function excursion()
    {
        return $this->belongsTo(Excursion::class);
    }

}
