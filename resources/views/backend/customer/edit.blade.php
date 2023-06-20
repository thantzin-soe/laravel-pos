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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Customer</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Customer</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Customer Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $customer->name }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Customer Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $customer->email }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Customer Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $customer->phone }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Customer Address</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $customer->address }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="shopname" class="form-label">Customer Shop Name</label>
                                                <input type="text" class="form-control @error('shopname') is-invalid @enderror" id="shopname" name="shopname" value="{{ $customer->shopname }}">
                                                @error('shopname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account_holder" class="form-label">Account Holder</label>
                                                <input type="text" class="form-control @error('account_holder') is-invalid @enderror" id="account_holder" name="account_holder" value="{{ $customer->account_holder }}">
                                                @error('account_holder')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Account Number</label>
                                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ $customer->account_number }}">
                                                @error('account_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bank_name" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ $customer->bank_name }}">
                                                @error('bank_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bank_branch" class="form-label">Bank Branch</label>
                                                <input type="text" class="form-control @error('bank_branch') is-invalid @enderror" id="bank_branch" name="bank_branch" value="{{ $customer->bank_branch }}">
                                                @error('bank_branch')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Customer City</label>
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $customer->city }}">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Customer Image</label>
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
                                                <img src="{{ $customer->image_url ?? config('app.cloudinary_no_image_url') }}" id="showImage" class="rounded-circle avatar-lg img-thumbnail" alt="profile image">
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