<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'agencyName',
        'agencyResponsibleName',
        'agencyAttestation',
        'agencyAddress',
        'agencyPhone',
        'agencyLogo',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function excursions()
    {
        return $this->hasMany(Excursion::class);
    }
}
