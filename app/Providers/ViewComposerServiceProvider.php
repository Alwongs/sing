<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $categories = cache()->remember('global.categories', 600, function () {
                return Category::orderBy('title')->get();
            });

            $unpublishedPostsCount = cache()->remember('unpublished.posts.count', 600, function () {
                return Post::where('is_published', false)->count();
            });            

            $view->with([
                'categories' => $categories,
                'unpublishedPostsCount' => $unpublishedPostsCount,
            ]);
        });
    }

    public function register()
    {
        //
    }
}
