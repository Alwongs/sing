

<div class="form-element">
    <label>Image:</label>
    <input
        class="form-image"
        type="file"
        name="image"
        accept="image/jpeg, image/png, image/webp"        
    />
    @error('image')
        <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror    
</div>  
