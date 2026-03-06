@props([
    'isRoot' => ''
])

<div class="table-item__role">
    <b class="root-color">{{ $isRoot ? 'root' : '' }}</b>
</div>