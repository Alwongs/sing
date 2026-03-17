<div id="mobileMenu" class="mobile-menu hidden">

    <nav class="mobile-menu-nav">
        <h2 class="mobile-menu-nav__title">Auth</h2>      
        
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="mobile-menu-nav__link" type="submit" >Exit</button>
            </form>                        
        @else
            @if(env('ALLOW_REGISTRATION') == 'true') 
                <a class="mobile-menu-nav__link" href="{{ route('login') }}">Login</a>                
                <a class="mobile-menu-nav__link" href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </nav>

    <nav class="mobile-menu-nav">
        <h2 class="mobile-menu-nav__title">Navigation</h2>
        <ul class="mobile-menu-nav__list">
            @auth
                @if(auth()->user()->isRoot())
                    <li class="mobile-menu-nav__item">
                        <a
                            class="mobile-menu-nav__link"
                            href="{{ route('admin.dashboard') }}"
                        >
                            Admin
                        </a>
                    </li>                
                @endif 
            @endauth   
            <li class="mobile-menu-nav__item">
                <a
                    class="mobile-menu-nav__link {{ request()->routeIs('blog.index') ? 'active' : '' }}"
                    href="{{ route('blog.index') }}"
                >
                    Blog
                </a>
            </li> 
        </ul>
    </nav>    

    <nav class="mobile-menu-nav">
        <h2 class="mobile-menu-nav__title">Categories</h2>
        <ul class="mobile-menu-nav__list">
            @foreach($categories as $category)
                <li class="mobile-menu-nav__item">
                    <a
                        class="mobile-menu-nav__link"
                        href="{{ route('blog.category', ['category' => $category->slug]) }}"
                    >
                        {{ $category->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>