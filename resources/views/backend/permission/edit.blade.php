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
                                <form method="POST" action="{{ route('permissions.update', $permission->id) }}" enctype="multipart/form-data">
                                	@csrf
                                    @method("PUT")
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Permission Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Permission Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $permission->name }}">
                                        		@error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="group_name" class="form-label">Group Name</label>
                                                <select type="text" class="form-control @error('group_name') is-invalid @enderror" id="group_name" name="group_name">
                                                    <option selected disabled>Select Group</option>
                                                    <option value="pos" @if($permission->group_name == 'pos') selected @endif>pos</option>
                                                    <option value="employee" @if($permission->group_name == 'employee') selected @endif>employee</option>
                                                    <option value="customer" @if($permission->group_name == 'customer') selected @endif>customer</option>
                                                    <option value="supplier" @if($permission->group_name == 'supplier') selected @endif>supplier</option>
                                                    <option value="salary" @if($permission->group_name == 'salary') selected @endif>salary</option>
                                                    <option value="attendance" @if($permission->group_name == 'attendance') selected @endif>attendence</option>
                                                    <option value="category" @if($permission->group_name == 'category') selected @endif>category</option>
                                                    <option value="product" @if($permission->group_name == 'product') selected @endif>product</option>
                                                    <option value="expense" @if($permission->group_name == 'expense') selected @endif>expense</option>
                                                    <option value="orders" @if($permission->group_name == 'orders') selected @endif>orders</option>
                                                    <option value="stock" @if($permission->group_name == 'stock') selected @endif>stock</option>
                                                    <option value="roles" @if($permission->group_name == 'roles') selected @endif>roles</option>
                                                </select>
                                                @error('group_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                    
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