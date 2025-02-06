<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'seaman_id',
        'cert_id',
        'expire_days',
        'expire_months',
        'expiry_status',
        'to_date',
        'from_date',
        'is_valid',
        'is_flag',
        'is_unlimited',
        'licence_number',
        'issuer',
        'issuer_country',
        'is_archive',
        'is_required',
        'is_verified',
        'notes',
        '_check_sum',
        'group_id',
        'group_name',
        'is_confidential',
        'issuer_country_name',
        'cert_stcw_code',
        'cert_export_id',
        'cert_name'
    ];

    protected $casts = [
        'to_date' => 'date',
        'from_date' => 'date',
        'is_valid' => 'boolean',
        'is_flag' => 'boolean',
        'is_unlimited' => 'boolean',
        'is_archive' => 'boolean',
        'is_required' => 'boolean',
        'is_verified' => 'boolean',
        'is_confidential' => 'boolean',
        'expire_days' => 'integer',
        'expire_months' => 'integer'
    ];

    protected $appends = [
        'remaining_validity_days',
        'status_label'
    ];

    // Relationships
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'seaman_id');
    }

    // Scopes
    public function scopeValid($query)
    {
        return $query->where('is_valid', true)
            ->where(function ($query) {
                $query->where('to_date', '>', now())
                    ->orWhere('is_unlimited', true);
            });
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeExpiring($query, int $days = 90)
    {
        return $query->where('is_valid', true)
            ->where('is_unlimited', false)
            ->whereNotNull('to_date')
            ->whereBetween('to_date', [now(), now()->addDays($days)]);
    }

    public function scopeExpired($query)
    {
        return $query->where('is_unlimited', false)
            ->whereNotNull('to_date')
            ->where('to_date', '<', now());
    }

    public function scopeByGroup($query, string $groupId)
    {
        return $query->where('group_id', $groupId);
    }

    public function scopeFlags($query)
    {
        return $query->where('is_flag', true);
    }

    // Accessors
    public function getRemainingValidityDaysAttribute(): ?int
    {
        if ($this->is_unlimited) {
            return null;
        }

        if (!$this->to_date) {
            return 0;
        }

        return max(0, Carbon::now()->diffInDays($this->to_date, false));
    }

    public function getStatusLabelAttribute(): string
    {
        if ($this->is_unlimited) {
            return 'No Expiry';
        }

        if (!$this->to_date) {
            return 'Unknown';
        }

        if (!$this->is_valid) {
            return 'Invalid';
        }

        if ($this->to_date->isPast()) {
            return 'Expired';
        }

        $daysRemaining = $this->remaining_validity_days;

        if ($daysRemaining <= 30) {
            return 'Critical';
        }

        if ($daysRemaining <= 90) {
            return 'Warning';
        }

        return 'Valid';
    }

    public function getValidityPeriodAttribute(): string
    {
        if ($this->is_unlimited) {
            return 'Unlimited';
        }

        if (!$this->from_date || !$this->to_date) {
            return 'Not Specified';
        }

        return $this->from_date->format('d/m/Y') . ' - ' . $this->to_date->format('d/m/Y');
    }

    public function getCertificationDetailsAttribute(): array
    {
        return [
            'name' => $this->cert_name,
            'number' => $this->licence_number,
            'stcw_code' => $this->cert_stcw_code,
            'issuer' => [
                'name' => $this->issuer,
                'country' => $this->issuer_country_name
            ],
            'validity' => $this->validity_period,
            'status' => $this->status_label
        ];
    }

    // Helper Methods
    public function markAsVerified(): bool
    {
        return $this->update([
            'is_verified' => true,
            'is_valid' => true
        ]);
    }

    public function markAsInvalid(string $reason = null): bool
    {
        return $this->update([
            'is_valid' => false,
            'notes' => $reason ? ($this->notes . "\n" . $reason) : $this->notes
        ]);
    }

    public function archive(): bool
    {
        return $this->update([
            'is_archive' => true,
            'is_valid' => false
        ]);
    }

    public function extend(Carbon $newExpiryDate): bool
    {
        if ($this->is_unlimited) {
            return false;
        }

        return $this->update([
            'to_date' => $newExpiryDate,
            'expire_days' => Carbon::now()->diffInDays($newExpiryDate),
            'expire_months' => Carbon::now()->diffInMonths($newExpiryDate)
        ]);
    }

    public function isExpiringSoon(int $thresholdDays = 90): bool
    {
        if ($this->is_unlimited || !$this->to_date) {
            return false;
        }

        return $this->remaining_validity_days <= $thresholdDays;
    }

    public function needsRenewal(): bool
    {
        return !$this->is_unlimited &&
            $this->is_required &&
            $this->isExpiringSoon();
    }

    public function updateExpiryStatus(): void
    {
        $this->expiry_status = $this->status_label;
        $this->save();
    }

    public function validateRequirements(): bool
    {
        return $this->is_valid &&
            $this->is_verified &&
            ($this->is_unlimited || ($this->to_date && $this->to_date->isFuture()));
    }

    protected static function booted()
    {
        static::saving(function ($certification) {
            if (!$certification->is_unlimited && $certification->to_date) {
                $certification->expire_days = Carbon::now()->diffInDays($certification->to_date);
                $certification->expire_months = Carbon::now()->diffInMonths($certification->to_date);
            }
        });
    }
}
