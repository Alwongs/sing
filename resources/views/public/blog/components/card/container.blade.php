@props([
    'post'=> null,
    'sessionId' => ''
])

@if($post && $post->is_published)
    <article class="blog-card card">
        @include('public.blog.components.card.header', [
            'post' => $post,
        ])        
        @include('public.blog.components.card.main', [
            'post' => $post
        ])      
        @include('public.blog.components.card.footer', [
            'post' => $post,
            'sessionId' => $sessionId
        ])
    </article>
    @if(!$loop->last)
        @include('public.blog.components.divider')
    @endif     
@endif