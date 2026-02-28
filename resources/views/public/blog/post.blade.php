@extends('_layouts.public')

@section('content')
    @php
        $notApproved = 0;
        if (auth()->user()?->is_root) {
            $notApproved = $post->comments->count() - $post->approvedComments->count();
        }
    @endphp

    <header class="header">
        <h1 class="header__title">
            {{ $post->title }}
        </h1>
    </header>

    <section class="blog-detail card">

        <header class="blog-detail-header">
            <div class="blog-detail-header__image">
                {{-- <img src="{{ asset('images/default-avatar.webp') }}" alt="User avatar"> --}}
                <img src="{{ $post->user->image_url }}" alt="User avatar">
            </div>
            <p class="blog-detail-header__name">
                {{ $post->user->name }}
            </p>
        </header>

        @if($post->image_url)
            <div class="blog-card-image">
                <img
                    src="{{  $post->image_url }}"
                    alt="Post image" 
                    loading="lazy"
                />
            </div>
        @endif         

        <div class="blog-detail-content">{!! $post->text !!}</div>

        <footer class="blog-detail-footer">
            <p class="blog-detail-footer__date">
                {{ $post->created_at?->format('d.m.Y') }}
            </p>
        </footer>
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

