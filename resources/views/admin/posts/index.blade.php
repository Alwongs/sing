@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">Posts</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')
                @include('admin.components.create-btn', ['route' => route('posts.create')])              
            </div> 
        </header>

        <main class="main">
            <ul class="table">
                @foreach($posts as $post)
                    @include('admin.posts.components.post-item')
                @endforeach
            </ul>
        </main>
    </div>
@endsection