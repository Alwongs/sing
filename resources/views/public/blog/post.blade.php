@extends('_layouts.public')

@section('content')
    <header class="header">
        <h1 class="header__title">
            {{ $post->title }}
        </h1>
    </header>

    <section class="blog-detail card">
        
        {{-- Give class for style!!!!!!!!!!! --}}
        <p style="opacity: 0.4; margin-bottom:8px">avatar and name</p>

        @if($post->image_url)
            <div class="blog-card-image">
                <img
                    src="{{  $post->image_url }}"
                    alt="Post image" 
                    loading="lazy"
                />
            </div>
        @endif        
        <p>
            {{ $post->published_at?->format('d,m,Y') }}
        </p>   

        {{-- Give class for style!!!!!!!!!!! --}}
        <div style="margin-bottom:10px">{!! $post->text !!}</div>

        {{-- Give class for style!!!!!!!!!!! --}}
        <p style="opacity: 0.4; margin-bottom:8px">date and so on..</p>

    </section> 
    
    {{-- comments section --}}
    <section class="card">
        <h2 class="comment-section-title">Comments ({{$post->comments->count()}})</h2>  

        @include('public.blog.components.comment-form', ['postSlug' => $post->slug])

        @include('public.blog.components.comment-list', ['comments' => $post->comments])
    </section>
@endsection

