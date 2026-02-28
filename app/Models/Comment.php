<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [ 'post_id', 'user_id', 'guest_name', 'body', 'is_approved' ];
    protected $casts = ['is_approved' => 'boolean'];

    /* ---------- relations ---------- */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    /* ---------- helpers ---------- */
    public function authorName(): string
    {
        return $this->user?->name ?? $this->guest_name;
    }
}
