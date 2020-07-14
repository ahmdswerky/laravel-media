<?php

use Illuminate\Support\Str;

function am_get_value(?array $payload, string $key)
{
    return array_key_exists($key, $payload) ? $payload[$key] : null;
}

function am_class_name($model)
{
    return
        config('media.models') . '\\' .
        Str::studly( Str::singular($model) );
}
