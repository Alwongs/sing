@props([
    'post' => null
])

@if($post->image_url && !$post->highlighted_text)
    <div class="blog-card-image">
        <img
            src="{{  $post->image_url }}"
            alt="Post image" 
            loading="lazy"
        />
    </div>
@endif

<h2 class="blog-card-title">{{ $post->title }}</h2>

<div class="blog-card-text">

    {!! Str::limit($post->highlighted_text, 240) ?? Str::limit(strip_tags($post->text), 240) !!}    

    <a href="{{ route('blog.post', $post->slug) }}" class="read-more-link">
        Read more
    </a>

</div> 