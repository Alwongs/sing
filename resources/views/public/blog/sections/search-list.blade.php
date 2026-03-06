@if($posts->count() > 0)

    <p class="alert alert-info">Found posts: {{ $posts->count() }}</p>

    <section class="search-list card">
        @foreach($posts as $post)
            @include('public.blog.components.search-card.container', [
                'post' => $post,
            ])
        @endforeach
    </section>   

@else

    <div class="alert alert-empty">
        Ничего не найдено.
    </div>
    
@endif
