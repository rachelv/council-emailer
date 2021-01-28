<?php

namespace App;

use Illuminate\Support\Facades\App;

class Env
{
    public static function isLocal(): bool
    {
        return App::environment('local') === true;
    }

    public static function isProd(): bool
    {
        return App::environment('production') === true;
    }
}
