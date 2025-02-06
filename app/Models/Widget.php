<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'has_credentials',
        'username',
        'password',
        'user_id',
        'position_x',
        'position_y',
        'width',
        'height',
        'icon',
        'background_color',
        'border_color',
        'image_path'
    ];

    protected $casts = [
        'has_credentials' => 'boolean',
        'position_x' => 'integer',
        'position_y' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrl()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $record) {
            $tenant = Filament::getTenant();

            if ($tenant) {
                if(get_class($record) == Company::class){
                    return;
                }
                $record->company_id = $tenant->id;
            }
        });

        static::deleting(function ($widget) {
            if ($widget->image_path) {
                Storage::disk('public')->delete($widget->image_path);
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
