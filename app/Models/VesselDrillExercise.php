<?php

namespace App\Models;

use App\Models\Vessel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VesselDrillExercise extends Model
{
    protected $fillable = [
        'date',
        'type',
        'attachment',
    ];

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }
}
