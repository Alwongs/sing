@props([
    'editRoute' => '',
    'deleteRoute' => '',
    'model' => null,
    'confirmMessage' => null,
])

<div class="table-item-actions">

    @include('admin.components.table.item-btn-edit', [
        'route' => $editRoute
    ])

    @include('admin.components.table.item-btn-delete', [
        'route' => $deleteRoute,
        'confirmMesage' => $confirmMessage
    ])
</div>