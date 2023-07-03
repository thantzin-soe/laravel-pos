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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Admin</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Admin</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                                	@csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Admin Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Admin Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        		@error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Admin Username</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Admin Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                        		@error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Admin Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                       		 	@error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Admin Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="role_id" class="form-label">Assign Role</label>
                                                <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                                    <option disabled selected>Select Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected @endif>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        

                                    </div> <!-- end row -->

                                    <div class="row">
                                    	<div class="col-md-12">
                                    		<div class="mb-3">
                                                <label for="image" class="form-label">Admin Image</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                        		@error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                    	</div>
                                    </div>

                                    <div class="row">
                                    	<div class="col-md-12">
                                    		<div class="mb-3">
                                                <img src="{{ config('app.cloudinary_no_image_url') }}" id="showImage" class="rounded-circle avatar-lg img-thumbnail" alt="profile image">
                                            </div>
                                    	</div>
                                    </div>
                                    
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

	<script type="text/javascript">
		$(document).ready(function(){
			$("#image").change(function(e){
				var reader = new FileReader();
				reader.onload = function(e){
					$("#showImage").attr('src', e.target.result)
				}
				reader.readAsDataURL(e.target.files[0]);
			})
		})
	</script>
@endsection