@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">Comments</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
                @include('admin._components.create-btn', ['route' => route('posts.create')])              
            </div> 
        </header>

        <main class="main">
            <ul class="table">
                @if($comments->count())
                    @foreach($comments as $comment)
                        @include('admin.comments.components.comment-item')
                    @endforeach
                @else 
                    <li class="table-item empty-list">Empty list</li>                 
                @endif
            </ul>
        </main>
    </div>
@endsection