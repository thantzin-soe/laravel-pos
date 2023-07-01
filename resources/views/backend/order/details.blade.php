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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Order Details</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Order Details</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
							<div class="tab-pane" id="settings">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Order Details</h5>
                                <form method="POST" action="{{ route('orders.update', $order->id) }}">
                                    @csrf
                                    @method("PUT")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Customer Image</label>
                                            <img src="{{ $order->customer->image_url }}" class="rounded-circle avatar-lg img-thumbnail" alt="customer image">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Customer Name</label>
                                            <p class="text-danger">{{ $order->customer->name }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Customer Email</label>
                                            <p class="text-danger">{{ $order->customer->email }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Customer Phone</label>
                                            <p class="text-danger">{{ $order->customer->phone }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Order Date</label>
                                            <p class="text-danger">{{ $order->order_date }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Order Invoice</label>
                                            <p class="text-danger">{{ $order->invoice_no }}</p>
                                        </div>
                                    </div> <!-- end col -->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Payment Status</label>
                                            <p class="text-danger">{{ $order->payment_status }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Paid Amount</label>
                                            <p class="text-danger">{{ $order->pay }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Due Amount</label>
                                            <p class="text-danger">{{ $order->due ?? 0 }}</p>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Complete Order</button>
                                </div>
                                </form>


                                <div class="table-responsive mt-3">
                                    <table class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total(+Vat)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order_items as $item)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $item->product->image_url }}" class="rounded-circle img-thumbnail" alt="product image" style="width:50px;height:40px;">
                                                    </td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->product->code }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->unit_cost }}</td>
                                                    <td>{{ $item->total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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