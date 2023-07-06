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
                                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Pending Dues</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Pending Dues</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table dt-responsive nowrap w-100 order_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Order Date</th>
                                        <th>Payment</th>
                                        <th>Total</th>
                                        <th>Pay</th>
                                        <th>Due</th>
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

    <!-- Standard modal content -->
    <div id="invoice_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <div class="auth-logo">
                            <h3>Pay Due Amount</h3>
                        </div>
                    </div>
                    <form class="mt-4" method="POST" action="{{ route('update.due') }}">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" id="order_id">
                        <input type="hidden" name="pay" id="pay">

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="due" class="form-label">Pay Now</label>
                                <input type="text" class="form-control" name="due" id="due">
                                @error('due')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Due</button>
                        </div>
                    </form>
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.order_datatable').DataTable({
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
                ajax: "{{ route('orders.pending.due') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'customer.name', name: 'name', orderable: false},
                    {data: 'order_date', name: 'order_date', orderable: false},
                    {data: 'payment_status', name: 'payment_status', orderable: false},
                    {data: 'total', name: 'total', orderable: false},
                    {data: 'pay', name: 'pay'},
                    {data: 'due', name: 'due'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            }); 
        });

        function orderDue(id)
        {
            $.ajax({
                type: 'GET',
                url: '/orders/pending-due/' + id,
                dataType: 'json',
                success: function(data){
                    $("#due").val(data.due);
                    $("#order_id").val(data.id);
                    $("#pay").val(data.pay);
                }
            })
        }
</script>
@endsection