<?php

namespace App\Models;

use the;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    protected $guarded = [];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the principal for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function principals(): HasMany
    {
        return $this->hasMany(Principal::class);
    }

    public function vessels(): HasMany
    {
        return $this->hasMany(Vessel::class);
    }
}
