<aside class="aside">

    @auth
        <section class="aside-profile card">
            <div class="flex-container flex-start-center gap-20 mb-4">
                <div class="aside-profile__image">
                    <img src="{{ Auth::user()->image_url }}" alt="User avatar">
                </div>

                <form class="flex-1" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="btn btn-info-outline"
                    >
                        Exit
                    </button>
                </form>
            </div>

            <h2 class="aside-profile__name">{{ auth()->user()->name }}</h2>            
        </section>        
    @else
        <section class="aside-profile card">
            <div class="flex-container flex-start-center mb-4">
                <div class="aside-profile__image">
                    <img src="{{ asset(config('images.paths.guest-avatar')) }}" alt="User avatar">
                </div>
            </div>

            <h2 class="aside-profile__name">Guest</h2>            
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