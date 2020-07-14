<?php

return [
    'models' => 'App\\Models',

    'quality' => 75,
    
    'routes' => [
        [
            'prefix' => 'api',
            'middlewares' => [
                // while usage of image optimization packages, you'll need to apply middleware to each route group
                // 'optimizeImages',
            ],
        ],
        // [
        //     'prefix' => 'api/admin',
        //     'middlewares' => [
        //         // while usage of image optimization packages, you'll need to apply middleware to each route group
        //         'admin',
        //         'optimizeImages',
        //     ],
        // ],
    ],

    'table' => 'media',

    'filename' => [
        'length' => 20,
    ],

    'photos' => [
        'path' => env('APP_PHOTOS_PATH', 'public/photos/'),

        'max' => '2048',

        'allowed_extensions' => [
            'jpeg',
            'png',
            'svg',
        ],
    ],

    'videos' => [
        'path' => env('APP_VIDEOS_PATH', 'public/videos/'),

        'max' => '2048',

        'allowed_extensions' => [
            'jpeg',
            'png',
            'svg',
        ],

        // types
        'types' => [
            'video',
            'video-url',
        ],
    ],
    'files' => [
        'path' => env('APP_FILES_PATH', 'public/files/'),

        'max' => '2048',

        'allowed_extensions' => [
            'rar',
            'zip',
            'csv',
            'xls',
            'xlsx',
        ],
    ],
];
