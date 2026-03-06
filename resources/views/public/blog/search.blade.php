@extends('_layouts.public')

@section('content')

    @include('public.blog.sections.page-header', ['title' => 'Результаты поиска: "' .$searchText. '"'])   
    
    @include('public.blog.sections.search-list')

@endsection
