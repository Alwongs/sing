@props([
    'src' => null,
])

<div class="form-element">
    <div class="form-preview">
        <img
            src="{{  Storage::url('images/previews/' . $post->image_name) }}"
            alt="Изображение поста" 
        />                            
    </div>
</div>