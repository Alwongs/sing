@extends('_layouts.public')

@section('content')
    <header class="header">
        <h1 class="header__title">News</h1>
    </header>

    <section class="blog-list">
        @foreach($posts as $post)
            @include('public.blog.components.blog-card')
        @endforeach
    </section> 


@endsection
