@extends('_layouts.admin')

@section('content')
    <div class="users-index-container">
        <header class="header">
            <h1 class="header__title">Users</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
                {{-- @include('admin._components.create-btn', ['route' => route('users.create')])               --}}
            </div>            
        </header>

        <main class="main">
            <ul class="table">
                @foreach($users as $user)
                    @include('admin.users.components.user-item')
                @endforeach
            </ul>
        </main>
    </div>
@endsection