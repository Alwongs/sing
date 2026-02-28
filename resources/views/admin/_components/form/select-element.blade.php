@props([
    'array' => [],
    'name' => '',
    'value' => '',
    'item_id' => null,
    'placeholder' => 'select item'
])

<div class="form-element">
    <select
        class="form-select"
        id="{{ 'form_select_' . $name }}"
        name="{{ $name }}"
    >
        <option class="form-option" value="" disabled {{ !isset($item_id) ? 'selected' : '' }}>
            {{ $placeholder }}
        </option>

        @foreach($array as $item)
            <option
                class="form-option"
                value="{{ $item->id }}"
                {{ isset($item_id) && $item_id == $item->id ? 'selected' : '' }}
            >
                {{ $item->title }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="select-error-message">{{ $message }}</div>
    @enderror    
</div>