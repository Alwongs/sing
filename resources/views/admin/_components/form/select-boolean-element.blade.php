@props([
    'name' => 'is_published',
    'value' => null,
    'true_title' => 'True title',
    'false_title' => 'False title',
    'true_value' => 1,
    'false_value' => 0,
    'placeholder' => null
])

<div class="form-element">

    <select
        class="form-select"
        id="{{ 'form_select_' . $name }}"
        name="{{ $name }}"
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        <option class="form-option" value="{{ $true_value }}" {{ $value ? 'selected' : '' }}>
            {{ $true_title }}
        </option>

        <option class="form-option" value="{{ $false_value }}" {{ !$value? 'selected' : '' }}>
            {{ $false_title }}
        </option>
    </select>
</div> 