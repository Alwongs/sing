@props([
    'title' => 'Delete',
    'route' => '',
    'confirmMessage' => 'Are you sure you want to delete this element?'
])

<form action="{{ $route }}" method="POST">
    @csrf
    @method('DELETE') 

    <button
        class="btn btn-delete-outline"
        type="submit"
        onclick="return confirm('{{ $confirmMessage }}')"        
    >
        {{ $title }}
    </button>
</form>


