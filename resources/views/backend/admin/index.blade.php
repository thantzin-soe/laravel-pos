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
                                    <a href="{{ route('admins.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Admin</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Admin</h4>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $key = $admins->perPage() * ($admins->currentPage() - 1);
                                    @endphp
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <img src="{{ $admin->photo_url }}" width="50px" height="40px">
                                            </td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>
                                                @foreach($admin->roles as $role)
                                                    <span class="badge badge-pill bg-danger">{{ $role->name }} </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
                                                <form class="role-delete-{{ $admin->id }}" style="display:inline" method="POST" action="{{ route('admins.destroy', $admin->id) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button id="delete" data-form="role-delete-{{ $admin->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $admins->links() }}
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