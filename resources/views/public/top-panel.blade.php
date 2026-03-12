<header class="top-panel">
    <div class="container flex-container flex-between-center">
        <button class="mobile-menu-toggle" aria-label="Меню">
            <span></span><span></span><span></span> {{-- иконка гамбургера --}}
        </button>

        <nav class="top-panel-navigation">
            @auth
                @if(auth()->user()->isRoot())
                    <a class="top-panel-nav-link" href="{{ route('admin.dashboard') }}">Admin</a>  
                @endif 
            @endauth
            {{-- <a class="top-panel-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>         --}}
            <a class="top-panel-nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
        </nav>    

        <nav class="top-panel-auth-navigation">
            @auth
                <div></div>
            @else
                @if(env('ALLOW_REGISTRATION') == 'true') 
                    <a class="top-panel-auth-nav-link" href="{{ route('login') }}">Login</a>                
                    <a class="top-panel-auth-nav-link" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </nav> 
    </div>
</header>