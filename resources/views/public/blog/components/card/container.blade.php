@props([
    'post'=> null,
    'sessionId' => ''
])

@if($post)
    <article class="blog-card card">

        @include('public.blog.components.card.main', [
            'post' => $post
        ])      

        @include('public.blog.components.card.footer', [
            'post' => $post,
        ])

    </article>
@endif

@include('public.blog.components.divider')