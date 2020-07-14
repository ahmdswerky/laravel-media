<?php

use AhmdSwerky\Media\Media;
use Illuminate\Support\Facades\Route;

Route::apiResource('media', MediaController::class)->only('index');
Route::apiResource('media', MediaController::class)->except(['index', 'store', 'show']);
Route::post('media/{model}/{id}', 'MediaController@store')->name('media.store');
Route::get('media/{medium}', 'MediaController@show')->name('media.show');