@extends('_layouts.admin')

@section('content')
    <div class="posts-index-container">
        <header class="header">
            <h1 class="header__title">Categories</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
                @include('admin._components.create-btn', ['route' => route('categories.create')])              
            </div>            
        </header>

        <main class="main">
            <ul class="table">
                @foreach($categories as $category)
                    @include('admin.categories.components.category-item')
                @endforeach
            </ul>
        </main>
    </div>
@endsection