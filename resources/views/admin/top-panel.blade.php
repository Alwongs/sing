<div class="top-panel">
    <nav class="top-panel-navigation">
        <a class="top-panel-nav-link" href="{{ url('/') }}">Website</a>        
    </nav>

    <nav class="top-panel-navigation">
        <a class="top-panel-nav-link" href="{{ route('posts.index') }}">projects</a>
        <a class="top-panel-nav-link" href="{{ route('posts.index') }}">Blog</a>
    </nav>

    <nav class="top-panel-navigation">
        @auth
            <a class="top-panel-nav-link" href="{{ route('profile') }}">Профиль</a>

            <form action="{{ route('logout') }}" method="POST" class="top-panel-nav-link">
                @csrf
                <button type="submit"  class="top-panel-nav-link">Выйти</button>
            </form>
        @else
            <a class="top-panel-nav-link" href="{{ route('login') }}">Вход</a>
            <a class="top-panel-nav-link" href="{{ route('register') }}">Регистрация</a>
        @endauth
    </nav>    
</div>

