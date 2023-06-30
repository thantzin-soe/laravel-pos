@extends('admin_layouts.admin_dashboard')

@section('styles')
    <style type="text/css">
        #customer_id + .select2-container .select2-selection__rendered{
            line-height: 51px !important;
        }
        #customer_id + .select2-container .select2-selection--single{
            height: 55px !important;
        }
        #customer_id + .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 54px !important;
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">POS System</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">POS System</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>Mark</td>
                                        <td>
                                            <input type="number" min="0" value="0" style="width: 40px;"  name="">
                                        </td>
                                        <td>Mark</td>
                                        <td>Mark</td>
                                        <td>
                                            <a href="">
                                                <i class="fas fa-trash-alt" style="color: #ffffff"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-primary">
                                <br>
                                <p style="font-size: 18px; color: #fff;">Quantity : 3434</p>
                                <p style="font-size: 18px; color: #fff;">Subtotal : 3434</p>
                                <p style="font-size: 18px; color: #fff;">Vat : 3434</p>
                                <div><h2 class="text-white">Total :</h2><h1 class="text-white">3434</h1></div>
                            </div>
                            <form class="mt-4">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">Select Customer</label>
                                        <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">

                                        </select>
                                        @error('customer_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-primary waves-effect waves-light">Create Invoice</button>
                                </div>
                            </form>
                        </div>                                 
                    </div> <!-- end card -->

                </div> <!-- end col-->

                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
							<table class="table dt-responsive nowrap w-100 product_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
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
        $(function () {
            var table = $('.product_datatable').DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                    $(".dataTables_wrapper .row:last-of-type").addClass("mt-3");
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('pos') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            $('#customer_id').select2({
                ajax: {
                    url: '{{ route('customers.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (response, params) {
                        return {
                            results: response,
                        };
                     },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Choose Customer',
                templateResult: formatCustomer,
                templateSelection: formatCustomerSelection,
                escapeMarkup: function(m) {
                    return m;
                },
            });
        });
        function formatCustomer (customer) {
            if (!customer.id) {
                return customer.text;
            }

            var $container = $(
                "<img src='" + customer.image_url + "' style='width: 50px; max-width: 100%; height: auto'/>" + "<span style='margin-left: 10px;'>" + customer.name + "</span>"
            );

            return $container;
        }

        function formatCustomerSelection (customer) {
            if (!customer.id) {
                return customer.text;
            }
            var $container = $(
                "<img src='" + customer.image_url + "' style='width: 50px; max-width: 100%; height: auto'/>" + "<span style='margin-left: 10px;'>" + customer.name + "</span>"
            );

            return $container;
        }
</script>
@endsection