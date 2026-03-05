@extends('_layouts.public')

@section('content')   

    @include('public.blog.sections.page-header', ['title' => 'Blog'])        

    @include('public.blog.sections.blog-list')    

@endsection
