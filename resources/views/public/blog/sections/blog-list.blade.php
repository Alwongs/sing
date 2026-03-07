@if($posts->count() > 0)
    @php
        $sessionId = session()->getId();       
    @endphp
    
    <p class="alert alert-info">Found posts: {{ $posts->count() }}</p>
    <section class="blog-list">
        @foreach($posts as $post)
            @include('public.blog.components.card.container', [
                'post' => $post,
                'sessionId' => $sessionId
            ])
        @endforeach
    </section> 
@else
    <div class="alert alert-empty">
        Ничего не найдено.
    </div>
@endif
