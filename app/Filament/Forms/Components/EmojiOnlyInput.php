<?php

namespace App\Filament\Forms\Components;

use App\Rules\EmojiOnlyRule;
use Filament\Forms\Components\TextInput;
use TangoDevIt\FilamentEmojiPicker\EmojiPickerAction;

class EmojiOnlyInput extends TextInput
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->suffixAction(EmojiPickerAction::make('emoji-picker'))
            ->rules([new EmojiOnlyRule()])
            ->maxLength(2)
            ->afterStateUpdated(function (string $state, callable $set) {
                $emojiOnly = preg_replace('/[^\p{Emoji}]/u', '', $state);
                $set('icon', $emojiOnly);
            });
    }
}
