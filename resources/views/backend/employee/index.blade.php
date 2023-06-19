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
                                    <a href="{{ route('employees.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Employee</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Employees</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @php
                                    $key = 1;
                                @endphp
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $key++; }}</td>
                                        <td>
                                            <img src="{{ $employee->image_url }}" style="width:50px;height:40px">
                                        </td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->salary }}</td>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>
                                            <form class="employee-delete-{{ $employee->id }}" style="display:inline" method="POST" action="{{ route('employees.destroy', $employee->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button id="delete" data-form="employee-delete-{{ $employee->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</button>
                                            </form>
                                            
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