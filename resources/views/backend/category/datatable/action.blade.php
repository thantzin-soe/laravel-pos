<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
<form class="category-delete-{{ $category->id }}" style="display:inline" method="POST" action="{{ route('categories.destroy', $category->id) }}">
    @csrf
    @method("DELETE")
    <button id="delete" data-form="category-delete-{{ $category->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
</form>