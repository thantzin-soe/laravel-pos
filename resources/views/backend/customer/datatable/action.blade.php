<a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>
<form class="customer-delete-{{ $customer->id }}" style="display:inline" method="POST" action="{{ route('customers.destroy', $customer->id) }}">
    @csrf
    @method("DELETE")
    <button id="delete" data-form="customer-delete-{{ $customer->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</button>
</form>