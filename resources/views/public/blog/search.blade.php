

@extends('_layouts.public')

@section('content')



    <header class="header">
        <h1 class="header__title">Результаты поиска: "{{ $searchText }}"</h1>
    </header> 

    @if($posts->count() > 0)
        <p class="alert alert-info">Found posts: {{ $posts->count() }}</p>
        
        <section class="blog-list">
            @foreach($posts as $post)
                @include('public.blog.components.search-card')
            @endforeach
        </section> 
    @else
        <div class="alert alert-empty">
            Ничего не найдено.
        </div>
    @endif
@endsection
