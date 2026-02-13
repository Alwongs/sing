@props([
    'post'=> null
])

@if($post)
    <article class="blog-list-item card">
        <div class="blog-card-image">
            <img
                src="{{  $post->image_url }}"
                alt="Post image" 
                loading="lazy"
            />
        </div>    
        
        <h2 class="blog-card-title">{{ $post->title }}</h2>
    
        <p class="blog-card-text">{{ $post->text }}</p>

        <footer class="blog-card-footer">
            <div>        
                <p class="blog-card-footer__likes">
                    *likes*
                </p>  
            </div>  
            <div>      
                <p class="blog-card-footer__author">
                    {{ $post->user->name }}
                </p>
                <p class="blog-card-footer__date">
                    {{ $post->created_at->format('d.m.Y') }}
                </p>  
            </div>         
        </footer>
    </article>
@endif

@include('public.blog.components.divider')