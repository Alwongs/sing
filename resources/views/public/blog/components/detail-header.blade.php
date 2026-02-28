<header class="blog-detail-header">
    <div class="blog-detail-header__image">
        <img src="{{ $post->user->image_url }}" alt="User avatar">
    </div>
    <p class="blog-detail-header__name">
        {{ $post->user->name }}
    </p>
</header>