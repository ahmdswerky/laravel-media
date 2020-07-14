<?php

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use AhmdSwerky\Media\Helpers\ImageManager;

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

function am_get_config($path = 'media.connection.url')
{
    $array = [
        'media' => [
            'connection' => [
                'url' => 'http://localhost',
            ]
        ],
    ];

    $syllables = explode('.', $path);
    $result = null;

    for ($i = 0; $i < count($syllables); $i++) {
        if ( gettype($result) == 'array' ) {
            $result = am_get_value($result, $syllables[$i]);
        } else {
            $result = am_get_value($array, $syllables[$i]);
        }
    }

    return $result;
}
