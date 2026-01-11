@extends('_layouts.public')

@section('content')
    <div>
        <a href="{{ route('posts.index') }}">Назад к постам</a>

        <div>
            <h1>{{ $pos->title }}</h1>
            <p>
                {{ $post->published_at?->format('d,m,Y') }}
            </p>            
        </div>

        <div>{!! nl2br(e($post->body)) !!}</div>
    </div>
@endsection

