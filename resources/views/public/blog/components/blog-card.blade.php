@props([
    'post'=> null
])

@if($post)
    <article class="blog-card card">
        @if($post->image_url)
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
             {!! $post->highlighted_text ?? Str::limit(strip_tags($post->text), 150) !!}

            <a href="{{ route('blog.post', $post->slug) }}" class="read-more-link">
                Читать далее
            </a>
        </div>        

        @include('public.blog.components.card-footer', [
            'author' => $post->user->name,
            'date'   => $post->created_at,
            'commentsCount' => $post->comments->count()
        ])
    </article>
@endif

@include('public.blog.components.divider')