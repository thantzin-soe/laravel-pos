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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Employee</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Employee</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                                	@csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Employee Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        		@error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Employee Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                        		@error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Employee Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                       		 	@error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Employee Address</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="experience" class="form-label">Employee Experience</label>
                                                <select class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience">
                                                    <option value="1" {{ old('experience') == 1 ? "selected" : "" }}>1 Year</option>
                                                    <option value="2" {{ old('experience') == 2 ? "selected" : "" }}>2 Year</option>
                                                    <option value="3" {{ old('experience') == 3 ? "selected" : "" }}>3 Year</option>
                                                    <option value="4" {{ old('experience') == 4 ? "selected" : "" }}>4 Year</option>
                                                    <option value="5" {{ old('experience') == 5 ? "selected" : "" }}>5 Year</option>
                                                </select>
                                                @error('experience')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="salary" class="form-label">Employee Salary</label>
                                                <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="">
                                                @error('salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="vacation" class="form-label">Employee Vacation</label>
                                                <input type="text" class="form-control @error('vacation') is-invalid @enderror" id="vacation" name="vacation" value="">
                                                @error('vacation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Employee City</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="city" name="city" value="">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->

                                    <div class="row">
                                    	<div class="col-md-12">
                                    		<div class="mb-3">
                                                <label for="image" class="form-label">Employee Image</label>
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