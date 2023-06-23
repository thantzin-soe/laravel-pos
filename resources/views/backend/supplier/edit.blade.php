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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Supplier</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Supplier</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}" enctype="multipart/form-data">
                                	@csrf
                                    @method("PUT")
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Supplier Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Supplier Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $supplier->name }}">
                                        		@error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Supplier Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $supplier->email }}">
                                        		@error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Supplier Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $supplier->phone }}">
                                       		 	@error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Supplier Address</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $supplier->address }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="shopname" class="form-label">Supplier Shop Name</label>
                                                <input type="text" class="form-control @error('shopname') is-invalid @enderror" id="shopname" name="shopname" value="{{ $supplier->shopname }}">
                                                @error('shopname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Supplier Type</label>
                                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                                    <option selected disabled>Select Type</option>
                                                    <option value="Distributor" {{ $supplier->type == "Distributor" ? "selected" : "" }}>Distributor</option>
                                                    <option value="Whole Seller" {{ $supplier->type == "Whole Seller" ? "selected" : "" }}>Whole Seller</option>
                                                </select>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account_holder" class="form-label">Account Holder</label>
                                                <input type="text" class="form-control @error('account_holder') is-invalid @enderror" id="account_holder" name="account_holder" value="{{ $supplier->account_holder }}">
                                                @error('account_holder')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Account Number</label>
                                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ $supplier->account_number }}">
                                                @error('account_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bank_name" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ $supplier->bank_name }}">
                                                @error('bank_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bank_branch" class="form-label">Bank Branch</label>
                                                <input type="text" class="form-control @error('bank_branch') is-invalid @enderror" id="bank_branch" name="bank_branch" value="{{ $supplier->bank_branch }}">
                                                @error('bank_branch')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Supplier City</label>
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $supplier->city }}">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->

                                    <div class="row">
                                    	<div class="col-md-12">
                                    		<div class="mb-3">
                                                <label for="image" class="form-label">Supplier Image</label>
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
                                                <img src="{{ $supplier->image_url ?? config('app.cloudinary_no_image_url') }}" id="showImage" class="rounded-circle avatar-lg img-thumbnail" alt="profile image">
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