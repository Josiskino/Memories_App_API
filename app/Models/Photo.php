<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photoUrl',
        'is_main',
        'photoable_type',
        'photoable_id',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'status' => 'integer',
    ];

    public function photoable()
    {
        return $this->morphTo();
    }
}
