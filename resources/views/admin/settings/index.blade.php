@extends('_layouts.admin')

@section('content')
    <div class="settings-index-container">
        <header class="header">
            <h1 class="header__title">Settings</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')            
            </div> 
        </header>

        <main class="main">
            <ul class="table">
                <li class="table-item">
                    <div class="table-item__settings-name">
                        <a
                            href="{{ route('admin.settings.file-manage') }}"
                            class="table-item-link"
                        >
                            File management
                        </a>
                    </div>
                </li>                
            </ul>
        </main>
    </div>
@endsection