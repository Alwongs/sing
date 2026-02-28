<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    protected $routeKeyName = 'slug';

    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $baseSlug = Str::slug($category->title);
                $category->slug = $baseSlug . '-' . Str::substr(Str::uuid(), 0, 8);
            }
        });
    } 
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }   

    public function getRouteKeyName()
    {
        if (Request::is('admin/*')) {
            return 'id';
        }
        
        return 'slug'; 
    }      
}
