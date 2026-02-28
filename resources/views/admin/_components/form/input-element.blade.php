@props([
    'name' => '',
    'value' => ''
])

<div class="form-element">
    <input
        class="form-input"
        id="{{ 'form_input_' . $name }}"
        type="text"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ ucwords(str_replace('_', ' ', trim($name))) }}"
        required 
    />
</div>