@extends('_layouts.admin')

@section('content')
    <div class="settings-index-container">
        <header class="header">
            <h1 class="header__title">File management</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')            
            </div> 
        </header>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <main class="main">
            <section class="settings-section">
                <header class="settings-section__header">
                    <h2 class="settings-section__title">
                        Not used images ({{ $forgottenCount }})
                    </h2>
                </header>
                <main class="settings-section__main">
                    <p class="settings-section__description">

                    </p>

                    @if($forgottenCount > 0)
                        <ul class="settings-section__list">
                            @foreach($forgottenFiles as $title => $files)
                                @include('admin.settings.components.file-list')
                            @endforeach
                        </ul>
                    @endif
                </main>
                <footer class="settings-section__footer">
                    <div class="submit-section">
                        @if($forgottenCount > 0)
                            @include('admin.components.btn.delete-btn', [
                                'title' => 'Remove old images',
                                'route' => route('admin.cleanup.images.delete'),
                                'confirmMessage' => 'Are you sure you want to delete all unused images?'
                            ])  
                        @else
                            <div class="alert alert-info">Нет мусорных изображений — всё чисто!</div>
                        @endif
                    </div>
                </footer>
            </section>
        </main>
    </div>
@endsection
