@php
    $sessionId = session()->getId();  
@endphp

<section class="blog-detail card">
    @include('public.blog.components.detail.header', [
        'post' => $post        
    ])

    @include('public.blog.components.detail.content', [
        'post' => $post
    ])

    @include('public.blog.components.detail.footer', [
        'post' => $post,
        'sessionId' => $sessionId
    ])
</section>