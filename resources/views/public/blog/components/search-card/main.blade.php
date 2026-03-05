<div class="search-card-main">
    @if($post->image_url)
        <div class="search-card-image">
            <img
                src="{{  $post->image_url }}"
                alt="Post image" 
                loading="lazy"
            />
        </div>
    @endif

    <div class="search-card-content">
        <h2 class="search-card-title">{{ $post->title }}</h2>

        <div class="search-card-text">
            <a href="{{ route('blog.post', $post->slug) }}">
                {!! Str::limit($post->highlighted_text, 180) !!}    
            </a>
            <a href="{{ route('blog.post', $post->slug) }}" class="read-more-link">
                Read more
            </a>

        </div>
    </div>    
</div>