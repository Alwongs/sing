<aside class="aside">
    <div class="aside-search card">

        <h2 class="card__title">Search</h2>

        <form action="{{ route('blog.search') }}" class="aside-search__form" method="GET">
            <div class="aside-search__input-section">
                <input class="aside-search__input" type="text">
            </div>
            <div class="aside-search__btn-section">
                <input class="btn btn-info" type="submit" value="Search" />
            </div>
        </form>

    </div>   
</aside>