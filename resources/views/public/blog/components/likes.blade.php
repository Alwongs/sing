@props([
    'post' => null,
    'sessionId' => '',
])

@php
    $isLiked = $post->isLikedToday($sessionId);
@endphp

<div class="flex-container flex-start-center gap-5">
    @if($isLiked)
        <span class="like-btn liked">❤️</span>
    @else
        <form class="like-btn-form" method="POST" action="{{ route('blog.like.toggle', $post) }}">
            @csrf
            <button type="submit" class="like-btn">🤍</button>
        </form>
    @endif
    <p class="like-count">{{ $post->likesCount() }}</p> 
</div>