@extends('_layouts.guest')

@section('content')
    <div class="guest-container">
        <h1 class="form-title">Registration</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-section">
                <div class="form-element">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-input" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-element">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-element">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-input" id="password" name="password" required>
                </div>
            </div>

            <div class="submit-section">
                <a href="{{ route('login') }}">Have account?</a>                
                <button
                    class="submit-btn"
                    type="submit"
                >
                    Register
                </button>
            </div>
        </form>
    </div>
@endsection
