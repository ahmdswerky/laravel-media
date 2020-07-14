<?php

namespace AhmdSwerky\Media;

use AhmdSwerky\Media\Media;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MediaBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ( $this->app->runningInConsole() ) {
            $this->registerPublishing();
        }
        
        $this->registerResources();
    }
    
    public function register()
    {       
        $this->commands([
            Console\TestMediaPackage::class,
        ]);
        
        // Load Helper functions
        require_once __DIR__ . '/Helpers/HelperFunctions.php';
    }
    
    protected function registerResources()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/media.php', 'media');
        
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'media');
        
        $this->loadRoutes();
    }
    
    protected function loadRoutes()
    {
        $routes = config('media.routes') ?? [ ];
        foreach ($routes as $route) {
            Route::prefix($route['prefix'])->middleware($route['middlewares'])->namespace('AhmdSwerky\Media\Http\Controllers')->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            });
        }
    }
    
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/media.php' => config_path('media.php'),
        ], 'laravel-media-config');
    }
}