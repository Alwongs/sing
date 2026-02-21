@props([
    'postSlug' => null
])


<form class="comment-form" method="POST" action="{{ route('blog.comments.store', ['post' => $postSlug]) }}">
    @csrf

    @auth
        <div class="comment-form-element">
            <textarea class="comment-form-textarea" name="body" rows="3" required>{{old('body')}}</textarea>
        </div>

        @include('public.blog.components.form-error', ['field' => 'body'])            
    @else
        <div class="comment-form-element">
            <input type="text" class="comment-form-input" name="guest_name" value="{{old('guest_name')}}" placeholder="name" required>
            @include('public.blog.components.form-error', ['field' => 'guest_name'])   
        </div>

        <div class="comment-form-element">
            <input type="email" class="comment-form-input" name="guest_email" value="{{old('guest_email')}}" placeholder="email" required>
            @include('public.blog.components.form-error', ['field' => 'guest_email'])   
        </div>

        <div class="comment-form-element">
            <textarea class="comment-form-input" name="body" rows="4" placeholder="text" required>{{old('body')}}</textarea>
            @include('public.blog.components.form-error', ['field' => 'body'])   
        </div>
    @endauth

    <div class="flex-container flex-end-center">
        <button class="btn btn-10 btn-submit">Send</button>
    </div>
</form>
     