@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">{{ $category->title }}</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
                @include('admin._components.create-btn', [
                    'title' => 'Create Post',
                    'route' => route('admin.posts.create.with-category', $category->id)
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