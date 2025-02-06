<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relative extends Model
{
    use HasFactory;

    protected $fillable = [
        'seaman_id',
        'relative_id',
        'is_primary',
        'name',
        'surname',
        'sex',
        'id_code',
        'is_employed',
        'occupation',
        'employer_name',
        'is_owwa',
        'is_phil_health',
        'lang_id',
        'birth_date',
        'age',
        'full_name',
        'type_name',
        'address_id',
        'address_is_primary',
        'address_name',
        'address_city',
        'address_county',
        'country_id',
        'address_postal_index',
        'address_fax',
        'address_email',
        'address_phone',
        'address_lang_id',
        'full_address',
        'address_country_name',
        'country_name',
        'country_icao_a2',
        'country_icao_a3',
        'country_icao_n3'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_employed' => 'boolean',
        'is_owwa' => 'boolean',
        'is_phil_health' => 'boolean',
        'address_is_primary' => 'boolean',
        'birth_date' => 'date',
        'age' => 'integer'
    ];

    // Relationships
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'seaman_id');
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type_name', $type);
    }

    public function scopeAdults($query)
    {
        return $query->where('age', '>=', 18);
    }

    public function scopeEmployed($query)
    {
        return $query->where('is_employed', true);
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        // if ($this->full_name && ) {
        //     return $this->full_name;
        // }
        return trim("{$this->surname}, {$this->name}");
    }

    public function getCompleteAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address_name,
            $this->address_city,
            $this->address_county,
            $this->address_country_name,
            $this->address_postal_index
        ]);

        return implode(', ', $parts);
    }

    public function getContactInfoAttribute(): array
    {
        return [
            'phone' => $this->address_phone,
            'fax' => $this->address_fax,
            'email' => $this->address_email
        ];
    }

    // Helper Methods
    public function makeDefault(): bool
    {
        if (!$this->is_primary) {
            // Remove primary status from other relatives
            static::where('seaman_id', $this->seaman_id)
                ->where('id', '!=', $this->id)
                ->update(['is_primary' => false]);

            $this->is_primary = true;
            return $this->save();
        }

        return true;
    }

    public function updateContactInfo(array $data): bool
    {
        $fillable = [
            'address_phone',
            'address_fax',
            'address_email'
        ];

        $updateData = array_intersect_key($data, array_flip($fillable));
        return $this->update($updateData);
    }

    public function calculateAge(): int
    {
        if ($this->birth_date) {
            $this->age = $this->birth_date->age;
            $this->save();
            return $this->age;
        }
        return 0;
    }

    public function hasValidContactInfo(): bool
    {
        return !empty($this->address_phone) ||
            !empty($this->address_email);
    }

    public function isEmergencyContact(): bool
    {
        return $this->is_primary && $this->hasValidContactInfo();
    }

    public function getInsuranceInfo(): array
    {
        return [
            'owwa' => $this->is_owwa,
            'phil_health' => $this->is_phil_health,
            'employer' => $this->is_employed ? $this->employer_name : null,
            'occupation' => $this->occupation
        ];
    }

    public function updateEmploymentInfo(array $data): bool
    {
        return $this->update([
            'is_employed' => $data['is_employed'] ?? false,
            'occupation' => $data['occupation'] ?? null,
            'employer_name' => $data['employer_name'] ?? null
        ]);
    }
}
