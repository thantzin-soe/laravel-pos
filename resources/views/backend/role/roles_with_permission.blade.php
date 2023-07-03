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
                                    <a href="{{ route('roles.attach.permission') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Permissions to Role</a>
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
                                        <th>Permissions</th>
                                        <th width="18%">Action</th>
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
                                                @foreach($role->permissions as $permission)
                                                    <span class="badge rounded-pill bg-danger">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('roles.permission.edit', $role->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
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