<li class="table-item">

    @include('admin._components.table.item-id', [
        'id' => $user->id
    ])

    @include('admin._components.table.item-title', [
        'title' => $user->name,
        'url' => route('users.show', $user),
        'classes' => $user->is_root ? 'root-color' : '',
        'classes' => trim(
            ($user->is_root ? 'root-color' : '') .
            ($user->is_admin && !$user->is_root ? 'admin-color' : '')
        )
    ])  
    
    @if($user->is_root)
        @include('admin._components.table.item-root')   
    @endif       

    @if(!$user->is_root && $user->is_admin)
        @include('admin._components.table.item-admin')
    @endif      

    @include('admin._components.table.item-actions', [
        'editRoute'   => route('users.edit', $user),
        'deleteRoute' => route('users.destroy', $user),
        'model' => $user,
        'confirmMessage' => 'Are you sure you want to delete the category: "' . $user->name . '"'
    ])
</li>