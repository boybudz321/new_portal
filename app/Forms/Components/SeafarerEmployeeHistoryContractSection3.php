<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class SeafarerEmployeeHistoryContractSection3 extends Component
{
    protected string $view = 'forms.components.seafarer-employee-history-contract-section3';

    public static function make(): static
    {
        return app(static::class);
    }
}
