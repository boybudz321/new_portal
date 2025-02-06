<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmojiOnlyRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[\p{Emoji}]+$/u', $value);
    }

    public function message()
    {
        return 'The :attribute must contain only emoji characters.';
    }
}
