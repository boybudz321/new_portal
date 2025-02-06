<?php

namespace App\Models;

use App\Models\Vessel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VesselSafety extends Model
{
    protected $fillable = [
        'description',
        'date',
        'type',
        'attachment',
    ];

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }
}
