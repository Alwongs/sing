@extends('_layouts.public')

@section('content')
    <header class="header">
        <h1>Blog</h1>
    </header>

    <main class="main">
        <ul class="blog-list">
            @foreach($posts as $post)
                <li class="blog-list-item">
                    <h2 class="blog-list-item__title">{{ $post->title }}</h2>
                    <p>{!! $post->text !!}</p>
                </li>
            @endforeach
        </ul>
    </main>

    <footer class="footer">
        footer
    </footer>
@endsection
