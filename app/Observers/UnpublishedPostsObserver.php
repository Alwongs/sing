<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class UnpublishedPostsObserver
{
    // public function saved(Category $category): void
    // {
    //     Cache::forget('global.categories');
    // }

    /**
     * Handle the Category "created" event.
     */
    public function created(Post $post): void
    {
        Cache::forget('unpublished.posts.count');
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Post $post): void
    {
        Cache::forget('unpublished.posts.count');
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Post $post): void
    {
        Cache::forget('unpublished.posts.count');
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Post $post): void
    {
        Cache::forget('unpublished.posts.count');
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        Cache::forget('unpublished.posts.count');
    }
}
