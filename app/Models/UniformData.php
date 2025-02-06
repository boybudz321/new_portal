<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class UniformData extends Model
{
    use HasFactory;

    protected $table = 'uniform_data';

    protected $fillable = [
        'seaman_id',
        'height',
        'chest',
        'boilersuit',
        'boots',
        'sweater',
        'trousers',
        'pilot_shirt',
        'weight',
        'bmi',
        'eyes_color',
        'blood_rhesus',
        'blood_type',
        'religion_id',
        'religion_name',
        'measure_type',
        'insurance_name',
        'membership_no',
        'medical_plan',
        'main_member',
        'contact_no',
        'insurance_from_date',
        'insurance_to_date',
        'chronic_illness',
        'allergies',
        'medication',
        'smoking',
        'drinking',
        'tattoos',
        'hair_color'
    ];

    protected $casts = [
        'height' => 'decimal:2',
        'chest' => 'decimal:2',
        'weight' => 'decimal:2',
        'bmi' => 'decimal:2',
        'main_member' => 'boolean',
        'smoking' => 'boolean',
        'drinking' => 'boolean',
        'insurance_from_date' => 'date',
        'insurance_to_date' => 'date'
    ];

    protected $appends = [
        'uniform_sizes',
        'health_status',
        'insurance_status'
    ];

    // Relationships
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'seaman_id');
    }

    // Scopes
    public function scopeWithActiveInsurance($query)
    {
        return $query->where('insurance_to_date', '>', now());
    }

    public function scopeByReligion($query, $religionId)
    {
        return $query->where('religion_id', $religionId);
    }

    public function scopeByBloodType($query, $bloodType)
    {
        return $query->where('blood_type', $bloodType);
    }

    public function scopeWithHealthIssues($query)
    {
        return $query->whereNotNull('chronic_illness')
            ->orWhereNotNull('allergies')
            ->orWhereNotNull('medication');
    }

    public function scopeWithLifestyleFactors($query)
    {
        return $query->where('smoking', true)
            ->orWhere('drinking', true);
    }

    // Accessors
    public function getUniformSizesAttribute(): array
    {
        return [
            'boilersuit' => $this->boilersuit,
            'boots' => $this->boots,
            'sweater' => $this->sweater,
            'trousers' => $this->trousers,
            'pilot_shirt' => $this->pilot_shirt
        ];
    }

    public function getHealthStatusAttribute(): array
    {
        return [
            'bmi' => $this->bmi,
            'blood' => [
                'type' => $this->blood_type,
                'rhesus' => $this->blood_rhesus
            ],
            'physical' => [
                'height' => $this->height,
                'weight' => $this->weight,
                'eyes_color' => $this->eyes_color,
                'hair_color' => $this->hair_color
            ],
            'medical' => [
                'chronic_illness' => $this->chronic_illness,
                'allergies' => $this->allergies,
                'medication' => $this->medication
            ],
            'lifestyle' => [
                'smoking' => $this->smoking,
                'drinking' => $this->drinking,
                'tattoos' => $this->tattoos
            ]
        ];
    }

    public function getInsuranceStatusAttribute(): array
    {
        return [
            'provider' => $this->insurance_name,
            'plan' => $this->medical_plan,
            'membership' => $this->membership_no,
            'validity' => [
                'from' => $this->insurance_from_date?->format('Y-m-d'),
                'to' => $this->insurance_to_date?->format('Y-m-d'),
                'active' => $this->hasValidInsurance()
            ],
            'main_member' => $this->main_member,
            'contact' => $this->contact_no
        ];
    }

    public function getMeasurementsAttribute(): array
    {
        return [
            'type' => $this->measure_type,
            'height' => $this->height,
            'weight' => $this->weight,
            'chest' => $this->chest,
            'bmi' => $this->bmi
        ];
    }

    // Helper Methods
    public function calculateBMI(): float
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->measure_type === 'imperial'
                ? $this->height * 0.0254  // Convert inches to meters
                : $this->height / 100;    // Convert cm to meters

            $weightInKg = $this->measure_type === 'imperial'
                ? $this->weight * 0.453592  // Convert lbs to kg
                : $this->weight;

            $this->bmi = round($weightInKg / ($heightInMeters * $heightInMeters), 2);
            $this->save();

            return $this->bmi;
        }

        return 0.0;
    }

    public function updateMeasurements(array $data, string $measureType = null): bool
    {
        if ($measureType) {
            $this->measure_type = $measureType;
        }

        $success = $this->update(array_intersect_key($data, array_flip([
            'height',
            'weight',
            'chest',
            'boilersuit',
            'boots',
            'sweater',
            'trousers',
            'pilot_shirt'
        ])));

        if ($success) {
            $this->calculateBMI();
        }

        return $success;
    }

    public function updateHealthInfo(array $data): bool
    {
        return $this->update(array_intersect_key($data, array_flip([
            'chronic_illness',
            'allergies',
            'medication',
            'smoking',
            'drinking',
            'tattoos',
            'eyes_color',
            'hair_color',
            'blood_type',
            'blood_rhesus'
        ])));
    }

    public function updateInsurance(array $data): bool
    {
        return $this->update(array_intersect_key($data, array_flip([
            'insurance_name',
            'membership_no',
            'medical_plan',
            'main_member',
            'contact_no',
            'insurance_from_date',
            'insurance_to_date'
        ])));
    }

    public function hasValidInsurance(): bool
    {
        return $this->insurance_to_date &&
            $this->insurance_to_date->isFuture() &&
            $this->insurance_from_date &&
            $this->insurance_from_date->isPast();
    }

    public function needsUniformUpdate(): bool
    {
        return empty($this->boilersuit) ||
            empty($this->boots) ||
            empty($this->trousers) ||
            empty($this->pilot_shirt);
    }

    public function hasCompleteHealthInfo(): bool
    {
        return !empty($this->blood_type) &&
            !empty($this->blood_rhesus) &&
            !empty($this->height) &&
            !empty($this->weight);
    }

    public function convertToMetric(): void
    {
        if ($this->measure_type === 'imperial') {
            $this->height = round($this->height * 2.54, 2);        // inches to cm
            $this->weight = round($this->weight * 0.453592, 2);    // lbs to kg
            $this->chest = round($this->chest * 2.54, 2);          // inches to cm
            $this->measure_type = 'metric';
            $this->save();
            $this->calculateBMI();
        }
    }

    public function convertToImperial(): void
    {
        if ($this->measure_type === 'metric') {
            $this->height = round($this->height / 2.54, 2);        // cm to inches
            $this->weight = round($this->weight / 0.453592, 2);    // kg to lbs
            $this->chest = round($this->chest / 2.54, 2);          // cm to inches
            $this->measure_type = 'imperial';
            $this->save();
            $this->calculateBMI();
        }
    }

    public function getBMICategory(): string
    {
        if (!$this->bmi) {
            return 'Not Available';
        }

        switch (true) {
            case $this->bmi < 18.5:
                return 'Underweight';
            case $this->bmi < 25:
                return 'Normal';
            case $this->bmi < 30:
                return 'Overweight';
            default:
                return 'Obese';
        }
    }
}
