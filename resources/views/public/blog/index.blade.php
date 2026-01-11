@extends('_layouts.public')

@section('content')
    <header class="header">
        <h1>Blog</h1>
    </header>

    <main class="main">
        <ul class="blog-list">
            @foreach($posts as $post)
                @include('public.blog.components.post-list-item')
            @endforeach
        </ul>
    </main>

    <footer class="footer">
        footer
    </footer>
@endsection
