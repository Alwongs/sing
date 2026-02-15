@props([
    'post'=> null
])

@if($post)
    <article class="search-card card">
        
        <h2 class="search-card-title">{{ $post->title }}</h2>

        <div class="search-card-text-wrapper">
             {!! Str::limit($post->highlighted_text, 400) ?? Str::limit(strip_tags($post->text), 300) !!}

            <a href="{{ route('blog.post', $post->slug) }}" class="read-more-link">
                Читать далее
            </a>
        </div>        

        <footer class="search-card-footer">
            <div>        
                <p class="blog-card-footer__likes">
                    *likes*
                </p>  
            </div>  
            <div>      
                <p class="search-card-footer__author">
                    {{ $post->user->name }}
                </p>
                <p class="search-card-footer__date">
                    {{ $post->created_at->format('d.m.Y') }}
                </p>  
            </div>         
        </footer>
    </article>
@endif

@include('public.blog.components.divider')