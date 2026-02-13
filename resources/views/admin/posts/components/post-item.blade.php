<li class="table-item {{ !$post->is_published ? 'mute' : ''}}">

    {{-- @include('admin.components.table.item-id', ['id' => $post->id]) --}}

    @include('admin.components.table.item-title', ['title' => $post->title, 'url' => route('posts.show', $post)])    

    @include('admin.components.table.item-date', ['date' => $post->created_at])       

    @include('admin.components.table.item-actions', [
        'editRoute'   => route('posts.edit', $post),
        'deleteRoute' => route('posts.destroy', $post),
        'model' => $post,
        'confirmMessage' => 'Are you sure you want to delete the post: "' . $post->title . '"'
    ])
</li>