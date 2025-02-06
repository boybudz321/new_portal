<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'seaman_id',
        'relative_id',
        'beneficiary',
        'beneficiary_id_code',
        'beneficiary_address',
        'email',
        'phone',
        'account_number',
        'bank',
        'bank_name_id',
        'country_id',
        'address',
        'bank_details',
        'bank_iban_code',
        'bank_code',
        'bank_sort_code',
        'currency_id',
        'correspondent_bank',
        'correspondent_bank_account',
        'correspondent_bank_code',
        'lang_id',
        'status',
        'status_name',
        'is_mpo',
        'is_primary',
        '_check_sum',
        'bank_name',
        'currency_code',
        'country_name',
        'country_code',
        'country_icao_a2',
        'country_icao_a3',
        'country_icao_n3'
    ];

    protected $casts = [
        'is_mpo' => 'boolean',
        'is_primary' => 'boolean'
    ];

    protected $with = [
        'seafarer'
    ];

    protected $appends = [
        'formatted_account_number'
    ];

    // Relationships
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class, 'seaman_id');
    }

    public function relative(): BelongsTo
    {
        return $this->belongsTo(Relative::class, 'relative_id');
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCountry($query, $countryId)
    {
        return $query->where('country_id', $countryId);
    }

    public function scopeByBank($query, $bankName)
    {
        return $query->where('bank_name', $bankName);
    }

    public function scopeByBeneficiary($query, $beneficiary)
    {
        return $query->where('beneficiary', 'LIKE', "%{$beneficiary}%");
    }

    public function scopeMpo($query)
    {
        return $query->where('is_mpo', true);
    }

    // Accessors
    public function getFormattedAccountNumberAttribute(): string
    {
        if (empty($this->account_number)) {
            return '';
        }

        // Format based on IBAN if available
        if (!empty($this->bank_iban_code)) {
            return chunk_split($this->bank_iban_code, 4, ' ');
        }

        // Basic formatting for regular account numbers
        return chunk_split($this->account_number, 4, ' ');
    }

    public function getBankDetailsFormattedAttribute(): string
    {
        $details = [
            'Bank: ' . $this->bank_name,
            'Account: ' . $this->formatted_account_number,
            'Code: ' . $this->bank_code,
            'Currency: ' . $this->currency_code
        ];

        if ($this->bank_iban_code) {
            $details[] = 'IBAN: ' . $this->bank_iban_code;
        }

        if ($this->bank_sort_code) {
            $details[] = 'Sort Code: ' . $this->bank_sort_code;
        }

        return implode("\n", array_filter($details));
    }

    public function getBeneficiaryDetailsAttribute(): array
    {
        return [
            'name' => $this->beneficiary,
            'id_code' => $this->beneficiary_id_code,
            'address' => $this->beneficiary_address,
            'contact' => [
                'email' => $this->email,
                'phone' => $this->phone
            ]
        ];
    }

    public function getCorrespondentBankDetailsAttribute(): array
    {
        return [
            'name' => $this->correspondent_bank,
            'account' => $this->correspondent_bank_account,
            'code' => $this->correspondent_bank_code
        ];
    }

    // Helper Methods
    public function makeDefault(): bool
    {
        if (!$this->is_primary) {
            // Remove primary status from other bank accounts
            static::where('seaman_id', $this->seaman_id)
                ->where('id', '!=', $this->id)
                ->update(['is_primary' => false]);

            $this->is_primary = true;
            return $this->save();
        }

        return true;
    }

    public function updateStatus(string $status): bool
    {
        $validStatuses = ['active', 'inactive', 'suspended', 'closed'];

        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $this->status = $status;
        $this->status_name = ucfirst($status);
        return $this->save();
    }

    public function updateBeneficiary(array $data): bool
    {
        return $this->update([
            'beneficiary' => $data['name'] ?? $this->beneficiary,
            'beneficiary_id_code' => $data['id_code'] ?? $this->beneficiary_id_code,
            'beneficiary_address' => $data['address'] ?? $this->beneficiary_address,
            'email' => $data['email'] ?? $this->email,
            'phone' => $data['phone'] ?? $this->phone
        ]);
    }

    public function updateCorrespondentBank(array $data): bool
    {
        return $this->update([
            'correspondent_bank' => $data['name'] ?? $this->correspondent_bank,
            'correspondent_bank_account' => $data['account'] ?? $this->correspondent_bank_account,
            'correspondent_bank_code' => $data['code'] ?? $this->correspondent_bank_code
        ]);
    }

    public function hasValidBankDetails(): bool
    {
        return !empty($this->account_number) &&
            !empty($this->bank_name) &&
            !empty($this->bank_code);
    }

    public function hasValidBeneficiary(): bool
    {
        return !empty($this->beneficiary) &&
            (!empty($this->email) || !empty($this->phone));
    }

    public function isInternational(): bool
    {
        return !empty($this->bank_iban_code) ||
            !empty($this->correspondent_bank);
    }

    public function getRoutingDetails(): array
    {
        return [
            'bank_code' => $this->bank_code,
            'sort_code' => $this->bank_sort_code,
            'iban' => $this->bank_iban_code,
            'correspondent' => $this->correspondent_bank_details
        ];
    }
}
