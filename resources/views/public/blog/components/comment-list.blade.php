@props([
    'comments' => []
])

<section class="comment-list-section">
    @forelse($comments as $comment)
        <div class="comment">
            <header class="comment-header">
                <div class="comment-header__image">
                    <img src="{{ $comment->user->image_url }}" alt="User avatar">
                </div>
                <p class="comment-header__name">
                    {{ $comment->authorName() }}
                    {{-- {{$comment->authorName()}} --}}
                </p>
            </header>
            <p class="comment-body">{{$comment->body}}</p>
            <footer class="comment-footer">
                <p class="comment-footer__likes">likes</p>
                <p class="text-muted">{{$comment->created_at->diffForHumans()}}</p>
            </footer>
        </div>
    @empty
        <p>Пока нет комментариев. Будьте первым!</p>
    @endforelse        
</section>  