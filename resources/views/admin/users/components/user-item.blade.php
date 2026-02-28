<li class="table-item">

    @include('admin._components.table.item-id', [
        'id' => $user->id
    ])

    @include('admin._components.table.item-title', [
        'title' => $user->name,
        'url' => route('users.show', $user),
        'classes' => $user->is_root ? 'root-color' : ''
    ])  
    
    @include('admin._components.table.item-root', [
        'isRoot' => $user->is_root
    ])    

    @include('admin._components.table.item-actions', [
        'editRoute'   => route('users.edit', $user),
        'deleteRoute' => route('users.destroy', $user),
        'model' => $user,
        'confirmMessage' => 'Are you sure you want to delete the category: "' . $user->name . '"'
    ])
</li>