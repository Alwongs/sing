@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">Posts</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
                @include('admin._components.create-btn', ['route' => route('posts.create')])              
            </div> 
        </header>

        <main class="main">
            <ul class="table">
                @if(count($posts))
                    @foreach($posts as $post)
                        @include('admin.posts.components.post-item')
                    @endforeach
                @else 
                    <li class="table-item empty-list">Empty list</li>                 
                @endif
            </ul>
        </main>
    </div>
@endsection