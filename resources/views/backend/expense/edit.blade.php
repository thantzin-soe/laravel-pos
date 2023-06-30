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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Expense</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Expense</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('expenses.update', $expense->id) }}" enctype="multipart/form-data">
                                	@csrf
                                    @method("PUT")
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Expense</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="details" class="form-label">Expense Details</label>
                                                <textarea type="text" class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows=5>{{ $expense->details }}</textarea>

                                        		@error('details')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $expense->amount }}">

                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $expense->date }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control @error('month') is-invalid @enderror" id="month" name="month" value="{{ $expense->month }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ $expense->year }}">
                                            </div>
                                        </div>

                                    </div> <!-- end row -->
                                    
                                    <div class="">
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