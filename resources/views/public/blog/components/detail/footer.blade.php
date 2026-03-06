@props([
    'post' => null,
    'sessionId' => ''
])

<footer class="blog-detail-footer">
    @include('public.blog.components.likes', [
        'post' => $post,
        'sessionId' => $sessionId
    ])
    
    <p class="blog-detail-footer__date">
        {{ $post->created_at?->format('d.m.Y') }}
    </p>
</footer>