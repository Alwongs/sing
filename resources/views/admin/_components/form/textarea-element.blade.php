@props([
    'name' => '',
    'value' => '',
    'templates' => []
])

<div class="form-element">
    @include('admin._components.modals.display-result-textarea')

    <div class="form-element-js-btn-group" id="textarea_toolbar">
        @foreach($templates as $key => $template)
            <button type="button" class="form-element-js-btn" data-template="{{ $key }}">
                {{ strtoupper($key) }}
            </button>
        @endforeach  
        <button type="button" class="form-element-js-btn show-result-js-btn" id="show_result_btn">
            Show result
        </button>      
    </div>

    <textarea
        class="form-textarea"
        id="form_textarea_blog"
        name="{{ $name }}"
        placeholder="{{ ucwords(str_replace('_', ' ', trim($name))) }}"
        required
    >{{ $value }}</textarea>
</div>

<script>
    window.templates = @json($templates);
</script>