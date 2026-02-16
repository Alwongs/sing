@props([
    'author' => 'no author',
    'date' => null,
    'commentsCount' => 0
])

<footer class="blog-card-footer">
    <div>        
        <p class="blog-card-footer__comments">
            Comments: {{ $commentsCount }}
        </p>  
    </div>  
    <div>   
          
        <div class="blog-card-footer__author">
            <div class="blog-card-footer__image">
                <img src="{{ asset('images/default-avatar.webp') }}" alt="User avatar">
            </div>
            <p class="blog-card-footer__autor-name">
                {{ $author }}            
            </p> 
        </div>
        <p class="blog-card-footer__date">
            {{ optional($date)->format('d.m.Y') ?? 'no date' }}
        </p>  
    </div>         
</footer>