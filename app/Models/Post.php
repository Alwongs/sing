<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Stevebauman\Purify\Facades\Purify;

class Post extends Model
{ 
    use HasFactory;

    public const ROUTE_TO_CATEGORY_POSTS = 'categories.show';
    public const ROUTE_TO_POSTS = 'posts.index';    

    protected $fillable = ['title', 'slug', 'text', 'image_name', 'is_published', 'category_id', 'user_id'];    

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }   
    
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
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
    
    public function setTextAttribute($value)
    {
        $this->attributes['text'] = Purify::clean($value);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_name) {
            return Storage::url(config('images.paths.originals') . '/' . $this->image_name);
        }
        return null; // или путь к изображению по умолчанию
    }

    public function getPreviewUrlAttribute()
    {
        if ($this->image_name) {
            return Storage::url(config('images.paths.previews') . '/' . $this->image_name);
        }
        return null;
    }    

    public function getRouteKeyName()
    {
        return 'slug';
    }     
}
