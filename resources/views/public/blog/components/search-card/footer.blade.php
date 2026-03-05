@props([
    'post' => null,
])

<footer class="blog-card-footer">
    <div>             
        @if($post->approvedComments->count())
            <p class="blog-card-footer__comments">
                Comments: {{ $post->approvedComments->count() }}
            </p> 
        @endif 
    </div>  

    <div>   
        <div class="blog-card-footer__author">
            <div class="blog-card-footer__image">
                <img src="{{ $post->user->image_url }}" alt="User avatar">
            </div>
            <p class="blog-card-footer__autor-name">
                {{ $post->user->name }}            
            </p> 
        </div>

        <p class="blog-card-footer__date">
            {{ optional($post->created_at)->format('d.m.Y') ?? 'no date' }}
        </p>  
    </div>         
</footer>


