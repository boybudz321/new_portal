<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_type',
        'referencing_id',
        'is_primary',
        'name',
        'station',
        'city',
        'country_id',
        'postal_index',
        'fax',
        'email',
        'not_email_event',
        'not_sms_event',
        'phone',
        'mobile_phone',
        'county',
        'skype_name',
        'lang_id',
        'airport',
        'airport_id',
        '_check_sum',
        'airport_code',
        'airport_name',
        'country_name',
        'country_icao_a2',
        'country_icao_a3',
        'country_icao_n3'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'not_email_event' => 'boolean',
        'not_sms_event' => 'boolean'
    ];

    // Relationships
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'referencing_id');
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeWithEmail($query)
    {
        return $query->whereNotNull('email');
    }

    public function scopeWithPhone($query)
    {
        return $query->whereNotNull('phone')
            ->orWhereNotNull('mobile_phone');
    }

    // Accessors
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->station,
            $this->city,
            $this->county,
            $this->country_name,
            $this->postal_index
        ]);

        return implode(', ', $parts);
    }

    public function getContactInfoAttribute(): array
    {
        return [
            'phone' => $this->phone,
            'mobile' => $this->mobile_phone,
            'email' => $this->email,
            'fax' => $this->fax,
            'skype' => $this->skype_name
        ];
    }

    // Helper Methods
    public function makeDefault(): bool
    {
        if (!$this->is_primary) {
            // Remove primary status from other addresses
            static::where('referencing_id', $this->referencing_id)
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
            'phone',
            'mobile_phone',
            'email',
            'fax',
            'skype_name'
        ];

        $updateData = array_intersect_key($data, array_flip($fillable));
        return $this->update($updateData);
    }

    public function hasValidEmailAddress(): bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function hasCompleteContactInfo(): bool
    {
        return !empty($this->phone) ||
            !empty($this->mobile_phone) ||
            !empty($this->email);
    }
}
