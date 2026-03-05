@props([
    'post'=> null,
    'sessionId' => ''
])

@if($post)
    <article class="search-card">

        @include('public.blog.components.search-card.main')             

        @include('public.blog.components.search-card.footer', [
            'post' => $post,
        ])
    </article>
@endif
