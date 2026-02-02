@extends('_layouts.admin')

@section('content')
    <div class="form-container">
        <header class="header">
            <h1 class="header__title">Edit Category</h1>
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

            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="input-section">
                    <div class="form-element">
                        <input type="text" class="form-input" id="title" name="title" value="{{ $category->title }}" placeholder="Title" required>
                    </div>
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