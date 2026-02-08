@props([
    'title' => 'Create',
    'route' => ''
])

<a
    class="btn btn-info-outline"
    href="{{ $route }}"
>
    {{ $title }}
</a>