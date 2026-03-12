<div id="mobileMenu" class="mobile-menu hidden">

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