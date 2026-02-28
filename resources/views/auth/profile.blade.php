@extends('_layouts.admin')

@section('content')
    <div class="profile-container">
        <header class="header">
            <h1 class="header__title">Profile</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
            </div>
        </header> 

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="input-section">
                <div class="form-element">
                    <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-element">
                    <input type="email" class="form-input" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>  
                
                <div class="form-element">
                    <div class="form-preview">
                        @if($user->image_name)
                            <img
                                src="{{ route('admin.avatar.show', Auth::user()->id) }}"
                                alt="Изображение профиля" 
                            /> 
                        @else
                            <img src="" alt="no image">                        
                        @endif                      
                    </div>
                </div>                

                @include('admin._components.form.input-image-element')                  
            </div>              
            
            <div class="submit-section">
                <a
                    class=""
                    href="{{ route('changePassword') }}"
                >
                    Изменить пароль
                </a>

                <button
                    class="btn btn-submit"
                    type="submit"
                >
                    Update
                </button>
            </div> 
        </form>
    </div>
@endsection
