@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">{{ $category->title }}</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')
                @include('admin.components.create-btn', [
                    'route' => route('posts.create.with-category', $category->id)
                ])              
            </div> 
        </header>

        <main class="main">
            <ul class="table">
                @foreach($category->posts as $post)
                    @include('admin.posts.components.post-item')
                @endforeach
            </ul>
        </main>
    </div>
@endsection 