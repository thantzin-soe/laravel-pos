@if($pay_salary)
	<div class="badge bg-success">Full Paid</div>
@else
	<a href="{{ route('salaries.pay', ['year' => $year, 'month' => $month, 'employee' => $employee]) }}" class="btn btn-primary rounded-pill waves-effect waves-light">Pay Now</a>
@endif
