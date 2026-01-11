@extends('_layouts.admin')

@section('content')
    <div class="blog-page-container">
        <header class="header">
            <h1>Blog</h1>
            <a class="blog-create-link" href="{{ route('posts.create') }}">Create</a>
        </header>

        <main class="main">
            <ul class="blog-list">
                @foreach($posts as $post)
                    <li class="blog-list-item">
                        <h2 class="blog-list-item__title">{{ $post->title }}</h2>
                    </li>
                @endforeach
            </ul>
        </main>
    </div>


    <footer class="footer">
        footer
    </footer>
@endsection