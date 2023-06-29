<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
<a href="{{ route('products.code', $product->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light" title="View Barcode"><i class="fa-solid fa-barcode"></i></a>
<form class="product-delete-{{ $product->id }}" style="display:inline" method="POST" action="{{ route('products.destroy', $product->id) }}">
    @csrf
    @method("DELETE")
    <button id="delete" data-form="product-delete-{{ $product->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
</form>