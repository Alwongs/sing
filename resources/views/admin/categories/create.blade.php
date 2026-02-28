@extends('_layouts.admin')

@section('content')
    <div class="form-container">
        <header class="header">
            <h1 class="header__title">New Category</h1>
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

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <div class="input-section">
                    <div class="form-element">
                        <input type="text" class="form-input" id="title" name="title" placeholder="Title" required>
                    </div>
                </div>              
                
                <div class="submit-section">
                    <button
                        class="btn btn-submit"
                        type="submit"
                    >
                        Create
                    </button>
                </div>            
            </form>             
        </main>
    </div>


    <footer class="footer">
        footer
    </footer>
@endsection