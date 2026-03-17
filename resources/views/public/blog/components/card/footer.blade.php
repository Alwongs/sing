@props([
    'post' => null,
    'sessionId' => ''
])

<footer class="blog-card-footer">
    <div class="">   
        @include('public.blog.components.likes', [
            'post' => $post,
            'sessionId' => $sessionId
        ])             
        <p class="blog-card-footer__comments hide-in-mobile">
            Comments: {{ $post->approvedComments->count() }}
        </p>  
    </div>  

    <div class="">   
        <p class="blog-card-footer__date">
            {{ optional($post->created_at)->format('d.m.Y') ?? 'no date' }}
        </p>  
    </div>         
</footer>






















{{-- @php
    $notApproved = 0;
    if (auth()->user()?->is_root) {
        $notApproved = $post->comments->count() - $post->approvedComments->count();
    }       
@endphp --}}