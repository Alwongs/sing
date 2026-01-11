<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{ 
    use HasFactory;

    protected $fillable = ['title', 'slug', 'text', 'is_published', 'user_id'];

    public function author(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }
}
