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
                                    @if(auth()->user()->can('supplier.add'))
                                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Supplier</a>
                                    @endif
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Suppliers</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table dt-responsive nowrap w-100 supplier_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.supplier_datatable').DataTable({
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
                ajax: "{{ route('suppliers.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'email', name: 'email', orderable: false},
                    {data: 'phone', name: 'phone', orderable: false},
                    {data: 'type', name: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
      });
</script>
@endsection