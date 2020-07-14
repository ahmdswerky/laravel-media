![Laravel Media](logo.png)

<h1 align="center">
Upload and associate media to models
</h1>

Once installed you can use it as easy:
```php
$user->addMedia(
    request()->file('photo') // request file
);
```

Or with the use of storeAs:
```php
$user->addMedia(
    request()->file('photo')->storeAs(...)
);
```

More detailed approach:
```php
$post->addMedia(
    request()->file('photo'), // request file
    'photo', // type
    [
        'name'  => 'thumbnail',
        // can be used as image alternate text <img alt="title">
        'title' => 'Visiting the Eiffel Tower at Night', 
        'description' => 'The Eiffel Tower as a tourist...',
        'notes' => '...',
    ]
);
```

You can retrive all media for a user as easy as:
```php
$user->media();
```

with more specifi filtering:
```php
$user->media(
    'photo', // type
    'avatar' // name
);
```

or just:
```php
$user->media;
```
to fetch all model's media (photos, videos and files)

## Installation
You can install the package via composer:
```
composer require ahmdswerky/laravel-media
```
The package will automatically register itself.

After publishing the migration you can create the media table by running the migrations:

```
php artisan migrate
```

You can optionally publish the config file with:
```
php artisan vendor:publish --tag=laravel-media-config
```

## Routes
The packages also offer custom routes to handle uploading globally.
<br />
You can configure multiple routes with different prefixes in config file:

```php
'routes' => [
    [
        'prefix' => 'api',
        'middlewares' => [
            // while usage of image optimization packages, you'll need to apply middleware to each route group
            'optimizeImages',
        ],
    ],
    [
        'prefix' => 'api/admin',
        'middlewares' => [
            'admin',
        ],
    ],
],
```
that will generate the following routes:

```http
GET | HEAD  | /api/media                | optimizeImages
PUT | PATCH | /api/media/{medium}       | optimizeImages
DELETE      | /api/media/{medium}       | optimizeImages
GET | HEAD  | /api/media/{medium}       | optimizeImages
POST        | /api/media/{model}/{id}   | optimizeImages
```
which are the default routes (also customizable).
<br />
<br />
and these for the admin:
```http
GET | HEAD  | /api/admin/media              | admin
PUT | PATCH | /api/admin/media/{medium}     | admin
DELETE      | /api/admin/media/{medium}     | admin
GET | HEAD  | /api/admin/media/{medium}     | admin
POST        | /api/admin/media/{model}/{id} | admin
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.