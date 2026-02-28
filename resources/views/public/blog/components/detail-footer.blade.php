<footer class="blog-detail-footer">
    <div class="flex-container flex-start-center gap-5">
        @if($isLikedToday)
            <span class="like-btn liked">❤️</span>
        @else
            <form class="like-btn-form" method="POST" action="{{ route('blog.like.toggle', $post) }}">
                @csrf
                <button type="submit" class="like-btn">🤍</button>
            </form>
        @endif
        <p class="like-count">{{ $post->likesCount() }}</p> 
    </div>
    
    <p class="blog-detail-footer__date">
        {{ $post->created_at?->format('d.m.Y') }}
    </p>
</footer>