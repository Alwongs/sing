<?php

namespace App\Models\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Likeable
{
    /**
     * Связь с лайками.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Проверить, ставил ли этот посетитель лайк сегодня.
     */
    public function isLikedToday(string $identifier): bool
    {
        return $this->likes()
            ->where('identifier', $identifier)
            ->whereDate('created_at', today())
            ->exists();
    }

    /**
     * Добавить лайк от текущего посетителя.
     * Возвращает true, если лайк успешно добавлен, false — если уже лайкал сегодня.
     */
    public function like(string $identifier): bool
    {
        if ($this->isLikedToday($identifier)) {
            return false;
        }

        $this->likes()->create(['identifier' => $identifier]);
        return true;
    }

    /**
     * Количество всех лайков у поста.
     */
    public function likesCount(): int
    {
        return $this->likes()->count();
    }
}