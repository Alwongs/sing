@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">{{ $post->title }}</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')

                @include('admin.components.btn.edit-btn', [
                    'route' => route('posts.edit', $post)
                ])

                @include('admin.components.btn.delete-btn', [
                    'route' => route('posts.destroy', $post),
                    'confirmMessage' => 'Are you sure you want to delete the post: "' . $post->title . '"'
                ])                
            </div>
        </header>

        <main class="main">
            @if($post->image_name)
                <div class="post-detail-image-wrapper">
                    <img
                        src="{{  $post->image_url }}"
                        alt="Post image" 
                    />
                </div>
            @endif            

            <p>{{ $post->text }}</p>
        </main>
    </div>
@endsection
