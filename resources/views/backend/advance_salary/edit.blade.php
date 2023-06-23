@extends('admin_layouts.admin_dashboard')

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Employee</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Employee</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('advance_salaries.update', $advance_salary->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Advance Salary</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="employee_id" class="form-label">Employee</label>
                                                <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" data-width="100%">
                                                </select>
                                                @error('employee_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Salary Month</label>
                                                <select id="month" name="month" class="form-control @error('month') is-invalid @enderror">
                                                    <option selected disabled>Select Month</option>
                                                    <option value='January' @if($advance_salary->month == 'January') selected @endif>Janaury</option>
                                                    <option value='February' @if($advance_salary->month == 'February') selected @endif>February</option>
                                                    <option value='March' @if($advance_salary->month == 'March') selected @endif>March</option>
                                                    <option value='April' @if($advance_salary->month == 'April') selected @endif>April</option>
                                                    <option value='May' @if($advance_salary->month == 'May') selected @endif>May</option>
                                                    <option value='June' @if($advance_salary->month == 'June') selected @endif>June</option>
                                                    <option value='July' @if($advance_salary->month == 'July') selected @endif>July</option>
                                                    <option value='August' @if($advance_salary->month == 'August') selected @endif>August</option>
                                                    <option value='September' @if($advance_salary->month == 'September') selected @endif>September</option>
                                                    <option value='October' @if($advance_salary->month == 'October') selected @endif>October</option>
                                                    <option value='November' @if($advance_salary->month == 'November') selected @endif>November</option>
                                                    <option value='December' @if($advance_salary->month == 'December') selected @endif>December</option>
                                                </select>
                                                @error('month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Salary Year</label>
                                                <select id="year" name="year" class="form-control @error('year') is-invalid @enderror">
                                                    <option selected disabled>Select Year</option>
                                                </select>
                                                @error('year')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="advance_salary" class="form-label">Advance Salary</label>
                                                <input type="text" class="form-control @error('advance_salary') is-invalid @enderror" id="advance_salary" name="advance_salary" value="{{ $advance_salary->advance_salary }}">
                                                @error('advance_salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->

                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
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
    

    <script type="text/javascript">
        $(document).ready(function(){
            var currentYear = new Date().getFullYear();
            var max = currentYear + 3;
            select = document.getElementById('year');
            var oldYear = "{{ $advance_salary->year }}";

            for (var i = currentYear; i <= max; i++){
                var opt = document.createElement('option');
                opt.value = i;
                opt.innerHTML = i;

                if(oldYear == i)
                {
                    opt.selected = true;
                }
                select.appendChild(opt);
            }

            $('#employee_id').select2({
                data: [
                    { 
                        "id" : "{{ $advance_salary->employee->id }}", 
                        "text" : "{{ $advance_salary->employee->name }}",
                        "name" : "{{ $advance_salary->employee->name }}",
                        "image_url": "{{ $advance_salary->employee->image_url }}"
                    }
                ],
                ajax: {
                    url: '{{ route('employees.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (response, params) {
                        return {
                            results: response,
                        };
                     },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Choose Employee',
                templateResult: formatEmployee,
                templateSelection: formatEmployeeSelection,
                escapeMarkup: function(m) {
                    return m;
                },
            });

            function formatEmployee (employee) {
                if (!employee.id) return employee.name; 

                var $container = $(
                    "<img src='" + employee.image_url + "' style='width: 50px; max-width: 100%; height: auto'/>" + "<span style='margin-left: 10px;'>" + employee.name + "</span>"
                );

                return $container;
            }

            function formatEmployeeSelection (employee) {
                return employee.name;
            }
        })
    </script>
@endsection