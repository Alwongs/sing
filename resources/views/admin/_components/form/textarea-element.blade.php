@props([
    'name' => '',
    'value' => ''
])

<div class="form-element">
    <textarea
        class="form-textarea"
        id="{{ 'form_input_' . $name }}"        
        name="{{ $name }}"
        placeholder="{{ ucwords(str_replace('_', ' ', trim($name))) }}"
        required
    >{{ $value }}</textarea>
</div>
