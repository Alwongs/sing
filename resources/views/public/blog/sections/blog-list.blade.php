<section class="blog-list">
    @php
        $sessionId = session()->getId();       
    @endphp

    @foreach($posts as $post)

        @include('public.blog.components.card.container', [
            'post' => $post,
            'sessionId' => $sessionId
        ])

    @endforeach
</section> 