<li class="table-item {{ !$comment->is_approved ? 'mute' : ''}}">

    {{-- @include('admin._components.table.item-id', ['id' => $post->id]) --}}

    @include('admin._components.table.item-title', ['title' => $comment->body, 'url' => route('comments.show', $comment)])    

    @include('admin._components.table.item-date', ['date' => $comment->created_at])       

    @include('admin._components.table.item-actions', [
        'editRoute'   => route('comments.edit', $comment),
        'deleteRoute' => route('comments.destroy', $comment),
        'model' => $comment,
        'confirmMessage' => 'Are you sure you want to delete the comment: "' . $comment->body . '"'
    ])
</li>