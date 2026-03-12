<aside id="aside-left" class="aside aside-left">
    @auth
        <section class="aside-profile card">
            <div class="aside-profile__image">
                <img src="{{ Auth::user()->image_url }}" alt="User avatar">
            </div>

            <h2 class="aside-profile__name">{{ auth()->user()->name }}</h2>    
            
            <form class="width-full" action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="btn btn-info-outline"
                >
                    Exit
                </button>
            </form>            
        </section>        
    @else
        <section class="aside-profile card">
            <div class="flex-container flex-start-center mb-4">
                <div class="aside-profile__image">
                    <img src="{{ asset(config('images.paths.guest-avatar')) }}" alt="User avatar">
                </div>
            </div>

            <h2 class="aside-profile__name">Welcome Guest</h2>            
        </section>          
    @endauth

    <nav class="aside-nav card">
        <h2 class="card__title">Categories</h2>
        <ul class="aside-nav__list">
            @foreach($categories as $category)
                <li class="aside-nav__item">
                    <a
                        class="aside-nav__link"
                        href="{{ route('blog.category', ['category' => $category->slug]) }}"
                    >
                        {{ $category->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</aside>