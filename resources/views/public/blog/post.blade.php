@extends('_layouts.public')

@section('content')

    @include('public.blog.sections.page-header', ['title' => $post->title])      

    @include('public.blog.sections.detail')
    
    @include('public.blog.sections.comments')

@endsection

