@extends('_layouts.public')

@section('content')

    @include('public.blog.sections.page-header', ['title' => $category->title])      

    @include('public.blog.sections.blog-list')           

@endsection
