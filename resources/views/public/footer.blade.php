<footer class="footer">
    <div class="container">
        <nav class="aside-nav footer-column">
            <h2 class="aside-nav__title">Categories</h2>
            <ul class="aside-nav__list">
                @foreach($categories as $category)
                    <li class="aside-nav__item">
                        <a class="aside-nav__link" href="">{{ $category->title }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</footer>  