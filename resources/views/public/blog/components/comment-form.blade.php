@props([
    'postSlug' => null
])

<form class="comment-form" method="POST" action="{{ route('blog.comments.store', ['post' => $postSlug]) }}">
    @csrf
          
    @unless (auth()->check())
        <div class="comment-form-element w-25">
            <input
                type="text"
                class="comment-form-input"
                name="guest_name"
                value="{{old('guest_name')}}"
                placeholder="Name">
            @include('public.blog.components.form-error', ['field' => 'guest_name'])   
        </div>
    @endunless

    <div class="comment-form-element">
        <textarea
            class="comment-form-textarea"
            name="body"
            rows="4"
            required>{{old('body')}}</textarea>
    </div>
    @include('public.blog.components.form-error', ['field' => 'body'])      

    <div class="flex-container flex-end-center">
        <button class="btn btn-10 btn-submit">Send</button>
    </div>
</form>
     