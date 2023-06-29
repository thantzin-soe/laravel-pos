@extends('admin_layouts.admin_dashboard')

@section('styles')
    
@endsection

@section('content')
	<div class="content">
		<!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Paid Salary</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Paid Salary</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('salaries.paid', $employee) }}" enctype="multipart/form-data">
                                	@csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Paid Salary</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="employee_id" class="form-label">Employee Name</label>
                                                <p>
                                                    <strong style="color: #fff">{{ $employee->name }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Salary Month</label>
                                                <p>
                                                    <strong style="color: #fff">{{ $month }}, {{ $year }}</strong>
                                                </p>
                                                <input type="hidden" name="month" value="{{ $month }}">
                                                <input type="hidden" name="year" value="{{ $year }}">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Salary</label>
                                                <p>
                                                    <strong style="color: #fff">{{ $employee->salary }}</strong>
                                                </p>
                                                <input type="hidden" name="paid_amount" value="{{ $employee->salary }}">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="advance_salary" class="form-label">Advance Salary</label>
                                                <p>
                                                    <strong style="color: #fff">
                                                        @if($advance_salary)
                                                            {{ $advance_salary->advance_salary }}
                                                            <input type="hidden" name="advance_salary" value="{{ $advance_salary->advance_salary }}">
                                                        @else
                                                            No Advance
                                                        @endif
                                                    </strong>

                                                </p>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="due_salary" class="form-label">Due Salary</label>
                                                <p>
                                                    <strong style="color: #fff">
                                                        @if($advance_salary)
                                                            {{ $employee->salary - $advance_salary->advance_salary }}
                                                            <input type="hidden" name="due_salary" value="{{ $employee->salary - $advance_salary->advance_salary }}">
                                                        @else
                                                            {{ $employee->salary }}
                                                            <input type="hidden" name="due_salary" value="{{ $employee->salary }}">
                                                        @endif 
                                                    </strong>
                                                </p>
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->

                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Paid</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->
                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->
	</div>

@endsection

@section('scripts')
    
@endsection