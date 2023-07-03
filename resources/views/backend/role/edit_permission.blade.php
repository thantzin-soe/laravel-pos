@extends('admin_layouts.admin_dashboard')

@section('styles')
    <style type="text/css">
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Permission</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Permission</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('roles.permission.update', $role->id) }}" enctype="multipart/form-data">
                                	@csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Roles Name</label>
                                                <h4>{{ $role->name }}</h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            
                                        </div>
                                    </div> <!-- end row -->

                                    <hr>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" value="" id="customcheck1">
                                                <label class="form-check-label" for="customcheck1">Primary</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    @foreach($permission_groups as $permission_group)
                                    @php 
                                        $permissions = \App\Models\User::getPermissionByGroupName($permission_group->group_name);
                                    @endphp
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" value="" id="permission_group_{{ $permission_group->group_name }}" {{ \App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="permission_group_{{ $permission_group->group_name }}">{{ $permission_group->group_name }}</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-9">
                                            @foreach($permissions as $permission)
                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permission[]" id="permission_{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach

                                    
                                    <div class="text-start">
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
        $("#customcheck1").click(function(){
            if($(this).is(":checked")){
                $("input[type=checkbox]").prop("checked", true);
            }else{
                $("input[type=checkbox]").prop("checked", false);
            }
        })
    </script>
@endsection