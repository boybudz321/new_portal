<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class EmploymentHistory extends Model
{
    use HasFactory;

    public $table = 'employment_history';

    protected $fillable = [
        'contract_id',
        'order_id',
        'vessel_id',
        'seaman_id',
        'rank_id',
        'template_id',
        'relief_id',
        'state',
        'invoice_office_id',
        'payroll_office_id',
        'contract_type',
        'eoc_date_ordered',
        'est_on_date',
        'boc_date',
        'on_date',
        'est_off_auto',
        'est_off_date',
        'off_date',
        'eoc_date',
        'on_days',
        'on_months',
        'service_days',
        'contract_days',
        'is_incomplete',
        'on_port',
        'on_country',
        'on_country_name',
        'off_country_name',
        'location_country_name',
        'on_route',
        'off_port',
        'off_country',
        'off_route',
        'off_reason_id',
        'off_request',
        'cpr_status',
        'cpr_signers',
        'tax_facility',
        '_check_sum',
        '_total',
        '_total_formated',
        'cert_check_date',
        'cert_ok',
        'cert_expired',
        'cert_expiring',
        'cert_missing',
        'payroll_office_name',
        'invoice_office_name',
        'relief_name',
        'seaman_full_name',
        'seaman_name',
        'seaman_surname',
        'seaman_country',
        'seaman_country_name',
        'pp_dob',
        'rank_name',
        'rank_long_name',
        'rank_export_id',
        'vessel_name',
        'vessel_country_code',
        'vessel_type_id',
        'vessel_dwt',
        'vessel_gt',
        'vessel_engine_id',
        'vessel_dp_type_id',
        'vessel_dp_manufacturer_id',
        'vessel_engine_model',
        'vessel_imo_no',
        'vessel_builder_id',
        'vessel_length',
        'vessel_engine_power',
        'vessel_year',
        'agent_name',
        'owner_name',
        'project_id',
        'project_name',
        'vessel_operation_id',
        'location_port',
        'location_country',
        'vessel_pump',
        'vessel_gear',
        'vessel_pump_name',
        'vessel_gear_name',
        'template_name',
        'template_include_file',
        'dp_type_name',
        'dp_manufacturer_name',
        'off_reason_name',
        'off_reason_color',
        'builder_name',
        'client_name',
        'contract_employer',
        'vessel_employer',
        'vessel_manager',
        'currency_code',
        'vessel_type_name',
        'vessel_type_export_id',
        'vessel_engine_name',
        'vessel_engine_export_id',
        'employment_vessel_name',
        'client_id',
        'vessel_client_id',
        'contract_template_id',
        'vessel_year_built',
        'vessel_grt',
        'cpr_template_id',
        'confirmed',
        'confirmed_date',

    ];

    protected $casts = [
        'eoc_date_ordered' => 'date',
        'est_on_date' => 'date',
        'boc_date' => 'date',
        'on_date' => 'date',
        'est_off_auto' => 'boolean',
        'est_off_date' => 'date',
        'off_date' => 'date',
        'eoc_date' => 'date',
        'on_days' => 'integer',
        'on_months' => 'integer',
        'service_days' => 'integer',
        'contract_days' => 'integer',
        'is_incomplete' => 'boolean',
        'off_request' => 'boolean',
        'tax_facility' => 'boolean',
        // '_total' => 'decimal:2',
        'cert_check_date' => 'date',
        'cert_ok' => 'integer',
        'cert_expired' => 'integer',
        'cert_expiring' => 'integer',
        'cert_missing' => 'integer',
        // 'vessel_dwt' => 'decimal:2',
        // 'vessel_gt' => 'decimal:2',
        // 'vessel_length' => 'decimal:2',
        // 'vessel_engine_power' => 'decimal:2',
        'confirmed' => 'boolean',
        'confirmed_date' => 'date',
    ];

    protected $appends = [
        'employment_period',
        'contract_status',
        'vessel_details',
        'certification_summary',
        'embarkation_details',
        'disembarkation_details'
    ];

    // Relationships
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'seaman_id');
    }

    public function relief(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'relief_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('off_date')
            ->whereNotNull('on_date');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('off_date')
            ->where('is_incomplete', false);
    }

    public function scopeByVessel($query, $vesselId)
    {
        return $query->where('vessel_id', $vesselId);
    }

    public function scopeByRank($query, $rankId)
    {
        return $query->where('rank_id', $rankId);
    }

    public function scopeByClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('on_date', [$startDate, $endDate])
                ->orWhereBetween('off_date', [$startDate, $endDate])
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('on_date', '<=', $startDate)
                        ->where(function ($q) use ($endDate) {
                            $q->where('off_date', '>=', $endDate)
                                ->orWhereNull('off_date');
                        });
                });
        });
    }

    public function scopePendingRelief($query)
    {
        return $query->whereNotNull('relief_id')
            ->whereNull('off_date')
            ->where('est_off_date', '<=', now()->addDays(30));
    }

    public function scopeWithCertificationIssues($query)
    {
        return $query->where(function ($q) {
            $q->where('cert_expired', '>', 0)
                ->orWhere('cert_missing', '>', 0);
        });
    }

    // Accessors
    public function getEmploymentPeriodAttribute(): array
    {
        return [
            'start' => [
                'planned' => $this->est_on_date?->format('Y-m-d'),
                'actual' => $this->on_date?->format('Y-m-d'),
                'contract_start' => $this->boc_date?->format('Y-m-d')
            ],
            'end' => [
                'planned' => $this->est_off_date?->format('Y-m-d'),
                'actual' => $this->off_date?->format('Y-m-d'),
                'contract_end' => $this->eoc_date?->format('Y-m-d')
            ],
            'duration' => [
                'days' => $this->service_days,
                'months' => $this->on_months,
                'contract_days' => $this->contract_days
            ]
        ];
    }

    public function getContractStatusAttribute(): array
    {
        return [
            'state' => $this->state,
            'type' => $this->contract_type,
            'template' => $this->template_name,
            'is_incomplete' => $this->is_incomplete,
            'employer' => $this->contract_employer,
            'cpr_status' => $this->cpr_status,
            'tax_facility' => $this->tax_facility
        ];
    }

    public function getVesselDetailsAttribute(): array
    {
        return [
            'basic' => [
                'name' => $this->vessel_name,
                'imo' => $this->vessel_imo_no,
                'type' => $this->vessel_type_name,
                'flag' => $this->vessel_country_code
            ],
            'specifications' => [
                'dwt' => $this->vessel_dwt,
                'gt' => $this->vessel_gt,
                'length' => $this->vessel_length,
                'year_built' => $this->vessel_year_built,
                'grt' => $this->vessel_grt
            ],
            'engine' => [
                'id' => $this->vessel_engine_id,
                'model' => $this->vessel_engine_model,
                'power' => $this->vessel_engine_power,
                'name' => $this->vessel_engine_name
            ],
            'equipment' => [
                'dp_type' => $this->dp_type_name,
                'dp_manufacturer' => $this->dp_manufacturer_name,
                'pump' => $this->vessel_pump_name,
                'gear' => $this->vessel_gear_name
            ],
            'management' => [
                'owner' => $this->owner_name,
                'manager' => $this->vessel_manager,
                'employer' => $this->vessel_employer,
                'agent' => $this->agent_name
            ]
        ];
    }

    public function getCertificationSummaryAttribute(): array
    {
        return [
            'check_date' => $this->cert_check_date?->format('Y-m-d'),
            'status' => [
                'valid' => $this->cert_ok,
                'expired' => $this->cert_expired,
                'expiring' => $this->cert_expiring,
                'missing' => $this->cert_missing
            ],
            'has_issues' => ($this->cert_expired + $this->cert_missing) > 0
        ];
    }

    public function getEmbarkationDetailsAttribute(): array
    {
        return [
            'port' => $this->on_port,
            'country' => $this->on_country_name,
            'route' => $this->on_route,
            'location' => [
                'port' => $this->location_port,
                'country' => $this->location_country_name
            ]
        ];
    }

    public function getDisembarkationDetailsAttribute(): array
    {
        return [
            'port' => $this->off_port,
            'country' => $this->off_country_name,
            'route' => $this->off_route,
            'reason' => [
                'id' => $this->off_reason_id,
                'name' => $this->off_reason_name,
                'color' => $this->off_reason_color
            ],
            'requested' => $this->off_request
        ];
    }

    // Helper Methods
    public function calculateServicePeriod(): void
    {
        if ($this->on_date) {
            $endDate = $this->off_date ?? now();

            $period = CarbonPeriod::create($this->on_date, $endDate);

            $this->service_days = $period->count();
            $this->on_months = $this->on_date->diffInMonths($endDate);

            $this->save();
        }
    }

    public function extendContract(Carbon $newEndDate, string $reason = null): bool
    {
        if (!$this->on_date || $this->off_date) {
            return false;
        }

        return $this->update([
            'eoc_date' => $newEndDate,
            'contract_days' => $this->on_date->diffInDays($newEndDate),
            'est_off_date' => $newEndDate,
            'notes' => $reason ? ($this->notes . "\nContract extended: " . $reason) : $this->notes
        ]);
    }

    public function recordDisembarkation(array $data): bool
    {
        if (!$this->on_date || $this->off_date) {
            return false;
        }

        $success = $this->update([
            'off_date' => $data['date'] ?? now(),
            'off_port' => $data['port'] ?? null,
            'off_country' => $data['country'] ?? null,
            'off_route' => $data['route'] ?? null,
            'off_reason_id' => $data['reason_id'] ?? null,
            'off_request' => $data['requested'] ?? false,
            'state' => 'completed'
        ]);

        if ($success) {
            $this->calculateServicePeriod();
        }

        return $success;
    }

    public function checkCertifications(): void
    {
        $validCerts = 0;
        $expiredCerts = 0;
        $expiringCerts = 0;
        $missingCerts = 0;

        // Logic to check certifications would go here
        // This would typically involve checking required certifications
        // for the specific rank and vessel type

        $this->update([
            'cert_check_date' => now(),
            'cert_ok' => $validCerts,
            'cert_expired' => $expiredCerts,
            'cert_expiring' => $expiringCerts,
            'cert_missing' => $missingCerts
        ]);
    }

    public function isActive(): bool
    {
        return $this->on_date && !$this->off_date;
    }

    public function isCompleted(): bool
    {
        return $this->off_date && !$this->is_incomplete;
    }

    public function hasValidContract(): bool
    {
        return $this->boc_date &&
            $this->eoc_date &&
            (!$this->off_date || $this->off_date <= $this->eoc_date);
    }

    public function isEligibleForRelief(): bool
    {
        return $this->isActive() &&
            $this->est_off_date &&
            $this->est_off_date->isPast();
    }

    public function getCurrentLocation(): array
    {
        return [
            'port' => $this->location_port,
            'country' => $this->location_country_name,
            'vessel' => $this->vessel_name,
            'last_updated' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function assignRelief(int $reliefSeamanId): bool
    {
        if (!$this->isActive() || !$this->est_off_date) {
            return false;
        }

        return $this->update([
            'relief_id' => $reliefSeamanId,
            'relief_name' => Seafarer::find($reliefSeamanId)?->full_name
        ]);
    }

    public function updateContractDates(array $dates): bool
    {
        $validDates = array_intersect_key($dates, array_flip([
            'est_on_date',
            'boc_date',
            'on_date',
            'est_off_date',
            'eoc_date'
        ]));

        if (empty($validDates)) {
            return false;
        }

        foreach ($validDates as $key => $value) {
            $this->$key = Carbon::parse($value);
        }

        if (isset($validDates['on_date']) && isset($validDates['eoc_date'])) {
            $this->contract_days = Carbon::parse($validDates['on_date'])
                ->diffInDays(Carbon::parse($validDates['eoc_date']));
        }

        return $this->save();
    }

    public function updateVesselInfo(array $data): bool
    {
        $vesselFields = [
            'vessel_name',
            'vessel_type_id',
            'vessel_dwt',
            'vessel_gt',
            'vessel_engine_id',
            'vessel_dp_type_id',
            'vessel_dp_manufacturer_id',
            'vessel_engine_model',
            'vessel_imo_no',
            'vessel_builder_id',
            'vessel_length',
            'vessel_engine_power',
            'vessel_year',
            'vessel_pump',
            'vessel_gear',
            'vessel_type_name',
            'vessel_engine_name',
            'vessel_grt'
        ];

        return $this->update(array_intersect_key($data, array_flip($vesselFields)));
    }

    public function getServiceSummary(): array
    {
        return [
            'position' => [
                'rank' => $this->rank_name,
                'rank_long' => $this->rank_long_name,
                'export_id' => $this->rank_export_id
            ],
            'vessel' => [
                'name' => $this->vessel_name,
                'type' => $this->vessel_type_name,
                'imo' => $this->vessel_imo_no
            ],
            'duration' => [
                'start' => $this->on_date?->format('Y-m-d'),
                'end' => $this->off_date?->format('Y-m-d'),
                'days' => $this->service_days,
                'months' => $this->on_months
            ],
            'contract' => [
                'type' => $this->contract_type,
                'employer' => $this->contract_employer,
                'start' => $this->boc_date?->format('Y-m-d'),
                'end' => $this->eoc_date?->format('Y-m-d'),
                'days' => $this->contract_days
            ],
            'locations' => [
                'embarkation' => [
                    'port' => $this->on_port,
                    'country' => $this->on_country_name
                ],
                'disembarkation' => [
                    'port' => $this->off_port,
                    'country' => $this->off_country_name
                ]
            ]
        ];
    }

    public function validateContractDates(): bool
    {
        if (!$this->boc_date || !$this->eoc_date) {
            return false;
        }

        // Contract start date should be before end date
        if ($this->boc_date->isAfter($this->eoc_date)) {
            return false;
        }

        // If on_date exists, it should be after or equal to boc_date
        if ($this->on_date && $this->on_date->isBefore($this->boc_date)) {
            return false;
        }

        // If off_date exists, it should be before or equal to eoc_date
        if ($this->off_date && $this->off_date->isAfter($this->eoc_date)) {
            return false;
        }

        return true;
    }

    public function calculateRemainingContractDays(): int
    {
        if (!$this->isActive() || !$this->eoc_date) {
            return 0;
        }

        return now()->diffInDays($this->eoc_date, false);
    }

    public function getProjectDetails(): array
    {
        return [
            'id' => $this->project_id,
            'name' => $this->project_name,
            'client' => [
                'id' => $this->client_id,
                'name' => $this->client_name
            ],
            'operation' => $this->vessel_operation_id
        ];
    }

    protected static function booted()
    {
        static::creating(function ($employment) {
            if (!$employment->contract_days && $employment->boc_date && $employment->eoc_date) {
                $employment->contract_days = $employment->boc_date->diffInDays($employment->eoc_date);
            }
        });

        static::updating(function ($employment) {
            // Update service period when off_date is being set
            if ($employment->isDirty('off_date') && $employment->off_date) {
                $employment->calculateServicePeriod();
            }

            // Update state based on dates
            if ($employment->on_date && !$employment->off_date) {
                $employment->state = 'active';
            } elseif ($employment->off_date) {
                $employment->state = 'completed';
            } elseif ($employment->est_on_date && $employment->est_on_date->isFuture()) {
                $employment->state = 'planned';
            }
        });
    }

    public function getDailyRate(): float
    {
        return $this->_total ? ($this->_total / ($this->contract_days ?: 30)) : 0.0;
    }

    public function getOvertime(): array
    {
        $contractDays = $this->contract_days ?: 0;
        $actualDays = $this->service_days ?: 0;

        $overtimeDays = max(0, $actualDays - $contractDays);

        return [
            'days' => $overtimeDays,
            'amount' => $overtimeDays * $this->getDailyRate()
        ];
    }

    public function generateContractSummary(): array
    {
        return [
            'reference' => [
                'contract_id' => $this->contract_id,
                'order_id' => $this->order_id,
                'template' => $this->template_name
            ],
            'period' => $this->employment_period,
            'financials' => [
                'currency' => $this->currency_code,
                'total' => $this->_total,
                'daily_rate' => $this->getDailyRate(),
                'overtime' => $this->getOvertime()
            ],
            'documentation' => [
                'cpr_status' => $this->cpr_status,
                'cpr_signers' => $this->cpr_signers,
                'template_file' => $this->template_include_file,
                'certification_status' => $this->certification_summary
            ],
            'administration' => [
                'payroll_office' => $this->payroll_office_name,
                'invoice_office' => $this->invoice_office_name,
                'tax_facility' => $this->tax_facility
            ]
        ];
    }
}
