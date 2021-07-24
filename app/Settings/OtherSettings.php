<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class OtherSettings extends Settings
{
    public static function group(): string
    {
        return 'other';
    }
}
