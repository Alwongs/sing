<aside class="aside">
    <nav class="aside-home-block">
        <a class="aside-home-block__link" href="{{ route('blog.index') }}">Website</a>        
    </nav>

    <div class="aside-auth-block">
        <div class="aside-auth-block-image">
            <img src="{{ auth()->user()->image_url }}" alt="">
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
            @if(auth()->user()->is_root)         
                <a class="aside-nav-link" href="{{ route('admin.posts.all-users-posts') }}">
                    All Posts @if($unpublishedPostsCount > 0) ({{ $unpublishedPostsCount }}) @endif 
                </a>
                <a class="aside-nav-link" href="{{ route('users.index') }}">Users</a>
                <a class="aside-nav-link" href="{{ route('admin.pollinations') }}">Pollinations</a>
                <a class="aside-nav-link" href="{{ route('admin.settings') }}">Settings</a>
            @endif

            @if(auth()->user()->is_admin)
                <a class="aside-nav-link" href="{{ route('categories.index') }}">Categories</a>
                <a class="aside-nav-link" href="{{ route('comments.index') }}">Comments</a>
            @endif     

            <a class="aside-nav-link" href="{{ route('posts.index') }}">My Posts</a>        
        </nav>
    </div>
</aside>