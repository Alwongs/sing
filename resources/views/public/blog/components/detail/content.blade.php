@props([
    'post' => null
])

@if($post->image_url)
    <div class="blog-card-image">
        <img
            src="{{  $post->image_url }}"
            alt="Post image" 
            loading="lazy"
        />
    </div>
@endif         

<div class="blog-detail-content">{!! $post->text !!}</div>