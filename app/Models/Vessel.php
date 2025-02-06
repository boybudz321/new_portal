<?php

namespace App\Models;

use App\Models\VesselSafety;
use App\Models\VesselDocument;
use App\Models\VesselDrillExercise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vessel extends Model
{
    use HasFactory;

    protected $primaryKey = 'vessel_id';

    protected $fillable = [
        'VslCode',
        'PrinCode',
        'SortCode',
        'Name',
        'VslTypeCode',
        'OffNbr',
        'PortofReg',
        'Classf',
        'YearBuilt',
        'GrossTon',
        'DeadWt',
        'NetTon',
        'EngType',
        'EngPower',
        'OwnerCode',
        'ActCode',
        'photo_directory',
        'flag2',
        'date_modified',
        'modified_by',
        'sync_stamp',
        'synced_by',
        'date_inserted',
        'inserted_by',
        'risk_profile',
        'risk_date',
        'risk_attachment',
        'ship_size',
        'avatar',
        'company_id'
    ];

    protected $casts = [
        'date_modified' => 'datetime',
        'sync_stamp' => 'datetime',
        'date_inserted' => 'datetime',
        'risk_date' => 'date',
    ];

    public function principals(): BelongsTo
    {
        return $this->belongsTo(Principal::class, 'PrinCode', 'PrinCode');
    }

    public function principal(): BelongsTo
    {
        return $this->belongsTo(Principal::class, 'PrinCode', 'PrinCode');
    }

    public function seafarers(): HasMany
    {
        return $this->hasMany(Seafarer::class, 'vessel_id', 'VslCode');
    }

    public function documents():HasMany
    {
        return $this->hasMany(VesselDocument::class);
    }
    public function safeties():HasMany
    {
        return $this->hasMany(VesselSafety::class);
    }
    public function drillexercises():HasMany
    {
        return $this->hasMany(VesselDrillExercise::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
