<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seafarer extends Model
{
    use HasFactory;

    protected static function booted(): void
    {

        static::creating(function ($user) {
            $user->company_id = Filament::getTenant()->id;
        });
    }

    protected $fillable = [
        'id',
        'manual_id',
        'old_id',
        'registration_date',
        'online_set_date',
        'online_date',
        'online_datetime',
        'client_date',
        'rank_id',
        'vessel_id',
        'photo_id',
        'country_id',
        'citizenship_id',
        'taxation_country_id',
        'taxation_id_code',
        'status',
        'surname',
        'name',
        'full_name',
        'middle_name',
        'calling_name',
        'national_full_name',
        'child_cnt',
        'fast_note',
        'fast_note2',
        'age',
        'pp_pob',
        'pp_dob',
        'pp_id_code',
        'pp_country_id',
        'primary_office_id',
        'primary_bank_id',
        'primary_address_id',
        '_check_sum',
        'primary_email',
        'not_sms_event',
        'not_email_event',
        'is_unsubscribe',
        'primary_address',
        'primary_postal_index',
        'primary_mobile',
        'primary_airport',
        'primary_relative_id',
        'primary_contact_id',
        'seniority_id',
        'seniority_days',
        'seniority_months',
        'sex',
        'marital_id',
        'acc_no',
        'curr_location',
        'curr_location_date',
        'available_from',
        'available_to',
        'marital_status',
        '_r_id',
        'rank_name',
        'rank_short_name',
        'rank_long_name',
        'rank_export_id',
        'status_name',
        'status_export_id',
        'country_code',
        'pp_country_code',
        'taxation_country_code',
        'pp_country_name',
        'taxation_country_name',
        'citizenship_name',
        'office_name',
        'office_registered_name',
        'country_name',
        'onboard_emp_id',
        'joining_emp_id',
        'planned_emp_id',
        'last_employment_state',
        'last_employment_off_date',
        'last_vessel_name',
        'last_vessel_id',
        'last_client_name',
        'available',
        'vessel_name',
        'last_employment_id',
        'last_contract_id',
        'last_deployment_id',
        'avatar',
        'esignature',
        'company_id',
    ];

    protected $casts = [
        'registration_date' => 'date',
        'online_set_date' => 'date',
        'online_date' => 'date',
        'online_datetime' => 'datetime',
        'client_date' => 'date',
        'pp_dob' => 'date',
        'curr_location_date' => 'date',
        'available_from' => 'date',
        'available_to' => 'date',
        'last_employment_off_date' => 'date',
        'not_sms_event' => 'boolean',
        'not_email_event' => 'boolean',
        'is_unsubscribe' => 'boolean',
        'age' => 'integer',
        'seniority_days' => 'integer',
        'seniority_months' => 'decimal:2',
        'child_cnt' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationships for new tables
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'referencing_id');
    }

    public function primaryAddress(): HasOne
    {
        return $this->hasOne(Address::class, 'referencing_id')->where('is_primary', true);
    }

    public function relatives(): HasMany
    {
        return $this->hasMany(Relative::class, 'seaman_id');
    }

    public function primaryRelative(): HasOne
    {
        return $this->hasOne(Relative::class, 'seaman_id')->where('is_primary', true);
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'seaman_id');
    }

    public function primaryBankAccount(): HasOne
    {
        return $this->hasOne(BankAccount::class, 'seaman_id')->where('is_primary', true);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class, 'seaman_id');
    }

    public function employmentHistory(): HasMany
    {
        return $this->hasMany(EmploymentHistory::class, 'seaman_id');
    }

    public function uniformData(): HasOne
    {
        return $this->hasOne(UniformData::class, 'seaman_id');
    }

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'VslCode');
    }

    public function vessels(): BelongsTo
    {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'VslCode');
    }

    public function lastVessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class, 'last_vessel_id', 'id');
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('available', true)
            ->whereNotNull('available_from')
            ->where('available_from', '<=', now());
    }

    public function scopeByRank($query, $rankId)
    {
        return $query->where('rank_id', $rankId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeWithValidCertifications($query)
    {
        return $query->whereHas('certifications', function ($query) {
            $query->where('is_valid', true)
                ->where(function ($q) {
                    $q->where('to_date', '>', now())
                        ->orWhere('is_unlimited', true);
                });
        });
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return trim("{$this->surname}, {$this->name} {$this->middle_name}");
    }

    public function getAgeFromDobAttribute(): int
    {
        return $this->pp_dob ? now()->diffInYears($this->pp_dob) : 0;
    }

    public function getCompleteAddressAttribute(): string
    {
        if ($this->primaryAddress) {
            return sprintf(
                "%s, %s, %s, %s",
                $this->primaryAddress->station,
                $this->primaryAddress->city,
                $this->primaryAddress->country_name,
                $this->primaryAddress->postal_index
            );
        }
        return '';
    }

    // Helper methods
    public function isAvailableForAssignment(): bool
    {
        return $this->available
            && $this->available_from
            && $this->available_from <= now()
            && (!$this->available_to || $this->available_to >= now());
    }

    public function hasValidDocuments(): bool
    {
        return $this->certifications()
            ->where('is_required', true)
            ->where(function ($query) {
                $query->where('to_date', '>', now())
                    ->orWhere('is_unlimited', true);
            })
            ->count() > 0;
    }

    public function getActiveCertifications()
    {
        return $this->certifications()
            ->where('is_valid', true)
            ->where(function ($query) {
                $query->where('to_date', '>', now())
                    ->orWhere('is_unlimited', true);
            })
            ->get();
    }

    public function updateEmploymentHistory(array $data): EmploymentHistory
    {
        return $this->employmentHistory()->create($data);
    }

    public function updateUniformData(array $data): UniformData
    {
        if ($this->uniformData) {
            $this->uniformData->update($data);
            return $this->uniformData;
        }

        return $this->uniformData()->create($data);
    }

    public function getPrimaryContactInformation(): array
    {
        return [
            'email' => $this->primary_email,
            'mobile' => $this->primary_mobile,
            'address' => $this->completeAddress,
            'emergency_contact' => $this->primaryRelative ? [
                'name' => $this->primaryRelative->full_name,
                'relationship' => $this->primaryRelative->type_name,
                'contact' => $this->primaryRelative->address_phone
            ] : null
        ];
    }

    public function getLatestEmployment()
    {
        return $this->employmentHistory()
            ->orderBy('on_date', 'desc')
            ->first();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
