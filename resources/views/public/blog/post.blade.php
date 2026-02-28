@extends('_layouts.public')

@section('content')
    @php
        $notApproved = 0;
        if (auth()->user()?->is_root) {
            $notApproved = $post->comments->count() - $post->approvedComments->count();
        }
        $identifier = session()->getId();
        $isLikedToday = $post->isLikedToday($identifier);        
    @endphp

    <header class="header">
        <h1 class="header__title">{{ $post->title }}</h1>
    </header>

    <section class="blog-detail card">
        @include('public.blog.components.detail-header')
        @include('public.blog.components.detail-content')
        @include('public.blog.components.detail-footer')
    </section> 
    
    {{-- comments section --}}
    <section class="card">
        <h2 class="comment-section-title">
            Comments ({{$post->approvedComments->count()}})

            @if($notApproved)
                <small class="comment-section-title__subtitle">not approved: {{ $notApproved }}</small>
            @endif
        </h2>  

        @include('public.blog.components.comment-form', ['postSlug' => $post->slug])

        @include('public.blog.components.comment-list', ['comments' => $post->approvedComments])
    </section>
@endsection

