<div class="top-panel">
    <nav class="top-panel-navigation">
        @auth
            @if(auth()->user()->isRoot())
                <a class="top-panel-nav-link" href="{{ route('dashboard') }}">Admin</a>  
            @endif 
        @endauth
        <a class="top-panel-nav-link" href="{{ route('home') }}">Home</a>        
        <a class="top-panel-nav-link" href="{{ route('blog.index') }}">Blog</a>
    </nav>    

    <nav class="top-panel-auth-navigation">
        @auth
            <a class="top-panel-auth-nav-link" href="{{ route('profile') }}">{{ auth()->user()->name; }}</a>

            <form action="{{ route('logout') }}" method="POST" class="top-panel-auth-nav-link">
                @csrf
                <button type="submit"  class="top-panel-auth-nav-link">Exit</button>
            </form>
        @else
            <a class="top-panel-auth-nav-link" href="{{ route('login') }}">Вход</a>
            <a class="top-panel-auth-nav-link" href="{{ route('register') }}">Регистрация</a>
        @endauth
    </nav>    
</div>