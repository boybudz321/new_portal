<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class SeafarerEmployeeHistoryContractSection4 extends Component
{
    protected string $view = 'forms.components.seafarer-employee-history-contract-section4';

    public static function make(): static
    {
        return app(static::class);
    }
}
