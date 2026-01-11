@extends('_layouts.guest')

@section('content')
    <div class="guest-container">
        <h1 class="form-title">Login</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-section">
                <div class="form-element">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-element">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-input" id="password" name="password" required>
                </div>
            </div>   
            
            <div class="submit-section">
                <a href="{{ route('register') }}">Register</a>
                <button
                    class="submit-btn"
                    type="submit"
                >
                    Login
                </button>
            </div>            
        </form>      
    </div>
@endsection
