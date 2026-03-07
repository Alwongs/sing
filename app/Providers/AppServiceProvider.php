<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use App\Contracts\ImageServiceInterface;
use App\Services\ImageService;
use App\Services\HtmlPurifierService;
use App\Observers\CategoryObserver;
use App\Observers\UnpublishedPostsObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
        $this->app->singleton(HtmlPurifierService::class, function () {
            return new HtmlPurifierService();
        });        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {  
        Category::observe(CategoryObserver::class); 
        Post::observe(UnpublishedPostsObserver::class); 
    }
}
