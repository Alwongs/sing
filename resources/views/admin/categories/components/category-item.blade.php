<li class="table-item">

    @include('admin.components.table.item-id', [
        'id' => $category->id
    ])

    @include('admin.components.table.item-title', [
        'title' => $category->title,
        'url' => route('categories.show', $category)
    ])    

    @include('admin.components.table.item-actions', [
        'editRoute'   => route('categories.edit', $category),
        'deleteRoute' => route('categories.destroy', $category),
        'model' => $category,
        'confirmMessage' => 'Are you sure you want to delete the category: "' . $category->title . '"'
    ])
</li>