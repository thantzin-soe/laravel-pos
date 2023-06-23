<a href="{{ route('advance_salaries.edit', $advance_salary->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
<form class="advance-salary-delete-{{ $advance_salary->id }}" style="display:inline" method="POST" action="{{ route('advance_salaries.destroy', $advance_salary->id) }}">
    @csrf
    @method("DELETE")
    <button id="delete" data-form="advance-salary-delete-{{ $advance_salary->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
</form>