<li class="blog-list-item">
    <header class="blog-list-item__header">
        <p class="blog-list-item__date">{{ $post->created_at->format('d.m.Y') }}</p>
        <h2 class="blog-list-item__title">{{ $post->title }}</h2>
    </header>
    
    <p>{!! $post->text !!}</p>
</li>

@include('public.blog.components.post-list-divider')