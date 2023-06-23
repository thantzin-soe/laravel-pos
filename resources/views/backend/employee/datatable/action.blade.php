<a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
<form class="employee-delete-{{ $employee->id }}" style="display:inline" method="POST" action="{{ route('employees.destroy', $employee->id) }}">
    @csrf
    @method("DELETE")
    <button id="delete" data-form="employee-delete-{{ $employee->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
</form>