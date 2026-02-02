@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">{{ $post->title }}</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')
            </div>
        </header>

        <main class="main">
            <p>{{ $post->text }}</p>
        </main>
    </div>
@endsection