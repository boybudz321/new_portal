<?php

namespace App\Models;

use App\Models\Vessel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VesselDocument extends Model
{
    protected $fillable = [
        'document_title',
        'date_expiry',
        'attachment',
    ];

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }
}
