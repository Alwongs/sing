<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{ 
    use HasFactory;

    public const REDIRECT_CATEGORY_POSTS = 'categories.show';
    public const REDIRECT_POSTS = 'posts.index';    

    protected $fillable = ['title', 'slug', 'text', 'is_published', 'category_id', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }    

    protected static function booted()
    {
        static::creating(function ($post) {
            if (Auth::check() && !$post->user_id) {
                $post->user_id = Auth::id();
            }

            if ($post->title) {            
                $originalSlug = $slug = Str::slug($post->title);

                // ✅ 3. Проверяем уникальность с помощью одного запроса
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                $post->slug = $slug;
            }
        });
    }    
}
