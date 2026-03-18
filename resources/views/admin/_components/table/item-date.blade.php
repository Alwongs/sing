@props([
    'date' => 'no prop'
])

<div class="table-item__date hide-in-mobile">
    {{ $date->format('d.m.Y') }}
</div>