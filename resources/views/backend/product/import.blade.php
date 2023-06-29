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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Import Products</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Import Products</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('products.import') }}" enctype="multipart/form-data">
                                	@csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Product Import</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="import_file" class="form-label">Upload excel file(xlsx)</label>
                                                <input type="file" class="form-control @error('import_file') is-invalid @enderror" id="import_file" name="import_file" value="{{ old('import_file') }}">
                                        		@error('import_file')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div> <!-- end row -->
                                    
                                    <div class="text-start">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Upload</button>
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