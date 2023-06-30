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
                                <li class="breadcrumb-item active">
                                    <a href="{{ route('expenses.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Expense</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Today Expense</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4" align="center" style="font-size: 24px;">Today Expense : {{ $total_expense }}</h4>
                            <table class="table dt-responsive nowrap w-100 customer_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $key => $expense)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $expense->details }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->month }}</td>
                                            <td>{{ $expense->year }}</td>
                                            <td>
                                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-info rounded-pill waves-effect waves-light">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@section('scripts')
    
@endsection