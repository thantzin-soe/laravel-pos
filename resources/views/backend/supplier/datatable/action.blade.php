<a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
<form class="supplier-delete-{{ $supplier->id }}" style="display:inline" method="POST" action="{{ route('suppliers.destroy', $supplier->id) }}">
    @csrf
    @method("DELETE")
    <button id="delete" data-form="supplier-delete-{{ $supplier->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
</form>
<a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info rounded-pill waves-effect waves-light"><i class="fa-solid fa-eye"></i></a>
