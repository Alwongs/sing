@extends('_layouts.admin')

@section('content')
    <div class="form-container">
        <header class="header">
            <h1 class="header__title">Edit Post</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')
            </div>
        </header>

        <main class="main">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="input-section">

                    @include('admin.components.form.input-element', [
                        'name' => 'title',
                        'value' => $post->title
                    ])  
                    @include('admin.components.form.textarea-element', [
                        'name' => 'text',
                        'value' => $post->text
                    ])                       
                    
                    @include('admin.components.form.select-boolean-element', [
                        'name' => 'is_published',
                        'value' => $post->is_published,
                        'true_title' => 'Published',
                        'false_title' => 'Not published',
                    ]) 
                </div>              
                
                <div class="submit-section">
                    <button
                        class="btn btn-submit"
                        type="submit"
                    >
                        Update
                    </button>
                </div>            
            </form>             
        </main>
    </div>

@endsection