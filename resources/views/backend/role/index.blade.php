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
                                    <a href="{{ route('roles.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Role</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Role</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table dt-responsive nowrap w-100 category_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $key = $roles->perPage() * ($roles->currentPage() - 1);
                                    @endphp
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
                                                <form class="role-delete-{{ $role->id }}" style="display:inline" method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button id="delete" data-form="role-delete-{{ $role->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $roles->links() }}
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