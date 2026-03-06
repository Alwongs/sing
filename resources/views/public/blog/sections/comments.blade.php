
@php
    $notApproved = 0;
    if (auth()->user()?->is_root) {
        $notApproved = $post->comments->count() - $post->approvedComments->count();
    }       
@endphp   
 
<section class="card">
    <h2 class="comment-section-title">
        Comments ({{$post->approvedComments->count()}})

        @if($notApproved)
            <small class="comment-section-title__subtitle">not approved: {{ $notApproved }}</small>
        @endif
    </h2>  

    @include('public.blog.components.comment.form', ['postSlug' => $post->slug])

    @include('public.blog.components.comment.list', ['comments' => $post->approvedComments])
</section>