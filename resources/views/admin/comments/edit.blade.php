@extends('_layouts.admin')

@section('content')
    <div class="form-container">
        <header class="header">
            <h1 class="header__title">Edit Comment</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
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

            <form action="{{ route('comments.update', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="input-section">

                    @include('admin._components.form.input-element', [
                        'name' => 'body',
                        'value' => $comment->body
                    ])                        
                    
                    @include('admin._components.form.select-boolean-element', [
                        'name' => 'is_approved',
                        'value' => $comment->is_approved,
                        'true_title' => 'Approved',
                        'false_title' => 'Not approved',
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