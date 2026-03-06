<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $categories = cache()->remember('global.categories', 600, function () {
                return Category::orderBy('title')->get();
            });

            $view->with('categories', $categories);
        });
    }

    public function register()
    {
        //
    }
}
