@extends('_layouts.public')

@section('content')
    <header class="header">
        <h1 class="header__title">
            {{ $post->title }}
        </h1>
    </header>

    <section class="blog-detail">
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
        <div>{!! $post->text !!}</div>
    </section>  

@endsection

