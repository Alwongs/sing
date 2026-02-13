<aside class="aside">
    <nav class="aside-home-block">
        <a class="aside-home-block__link" href="{{ url('/') }}">Website</a>        
    </nav>

    <div class="aside-auth-block">
        <div class="aside-auth-block-image">
            <img src="{{ asset('images/default-avatar.webp') }}" alt="">
        </div>

        <nav class="aside-auth-block-info">
            @auth
                <a class="aside-auth-block-info__profile-link" href="{{ route('profile') }}">
                    {{ auth()->user()->name }}
                </a>

                <form class="aside-auth-block-info__logout" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="aside-auth-block-info__logout" type="submit" >Exit</button>
                </form>
            @else
                <a class="aside-nav-link" href="{{ route('login') }}">Вход</a>
                <a class="aside-nav-link" href="{{ route('register') }}">Регистрация</a>
            @endauth
        </nav>
    </div>  

    <div class="aside-navigation-block">
        <h2 class="aside-navigation-block-title">
            Apps
        </h2>

        <nav class="aside-app-navigation">
            <a class="aside-nav-link" href="{{ route('admin.pollinations') }}">Pollinations</a>
            <a class="aside-nav-link" href="{{ route('categories.index') }}">Categories</a>
            <a class="aside-nav-link" href="{{ route('posts.index') }}">Posts</a>
            <a class="aside-nav-link" href="{{ route('admin.settings') }}">Settings</a>
        </nav>
    </div>
</aside>