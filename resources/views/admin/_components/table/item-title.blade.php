@props([
    'title' => 'no prop',
    'url' => '#',
    'classes' => ''
])

<a href="{{ $url }}" class="table-item__title one-line-text {{ $classes }}">
    {{ $title }}
</a>