@props([
    'post' => null
])

<header class="blog-card-header">
    <div class="blog-card-header__image">
        <img src="{{ $post->user->image_url }}" alt="User avatar">
    </div>
    <p class="blog-card-header__name">
        {{ $post->user->name }}
    </p>
</header>