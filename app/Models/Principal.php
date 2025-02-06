<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Principal extends Model
{
    use HasFactory;

    // protected $primaryKey = 'principal_id';

    protected $fillable = [
        'company_id',
        'PrinCode',
        'Abbrv',
        'Name',
        'Addr',
        'CntryCode',
        'Phone',
        'Telefax',
        'Email',
        'ActCode',
    ];

    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function vessels(): HasMany
    {
        return $this->hasMany(Vessel::class, 'PrinCode', 'PrinCode');
    }


}
