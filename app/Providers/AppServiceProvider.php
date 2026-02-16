<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use App\Contracts\ImageServiceInterface;
use App\Http\Services\ImageService;
use App\Services\HtmlPurifierService;
use App\Observers\CategoryObserver;

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
        // possible not used
        \Blade::directive('purify', function ($expression) {
            return "<?php echo HTMLPurifier::getInstance()->purify({$expression}); ?>";
        });     
        Category::observe(CategoryObserver::class); 
    }
}
