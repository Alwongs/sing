@props([
    'date' => 'no prop'
])

<div class="table-item__date">
    {{ $date->format('d.m.Y') }}
</div>