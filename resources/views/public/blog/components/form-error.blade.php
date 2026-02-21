@props([
    'field' => null,
    'message' => ''
])

@error($field)
    <div class="comment-form-error-note">{{$message}}</div>
@enderror