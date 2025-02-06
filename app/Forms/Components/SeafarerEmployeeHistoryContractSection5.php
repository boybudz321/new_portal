<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class SeafarerEmployeeHistoryContractSection5 extends Component
{
    protected string $view = 'forms.components.seafarer-employee-history-contract-section5';

    public static function make(): static
    {
        return app(static::class);
    }
}
