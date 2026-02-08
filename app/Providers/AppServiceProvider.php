<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ImageServiceInterface;
use App\Http\Services\ImageService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
