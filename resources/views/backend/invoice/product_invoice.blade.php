@extends('admin_layouts.admin_dashboard')

@section('styles')
    
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
                                <li class="breadcrumb-item active">Customer Invoice</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Customer Invoice</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b>Hello, {{ $customer->name }}</b></p>
                                        <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                            promises to provide high quality products for you as well as outstanding
                                            customer service for every transaction. </p>
                                    </div>

                                </div><!-- end col -->
                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3 float-end">
                                        <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; Jan 17, 2016</span></p>
                                        <p><strong>Order Status : </strong> <span class="float-end"><span class="badge bg-danger">Unpaid</span></span></p>
                                        <p><strong>Order No. : </strong> <span class="float-end">000028 </span></p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <h6>Billing Address</h6>
                                    <address>
                                        Stanley Jones<br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div> <!-- end col -->
                            </div> 
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4 table-centered">
                                            <thead>
                                            <tr><th>#</th>
                                                <th>Item</th>
                                                <th style="width: 10%">Quantity</th>
                                                <th style="width: 10%">Unit Cost</th>
                                                <th style="width: 10%" class="text-end">Total</th>
                                            </tr></thead>
                                            <tbody>
                                                @php
                                                    $key = 1;
                                                @endphp
                                                @foreach($cart_items as $cart_item)
                                                    <tr>
                                                        <td>{{ $key++ }}</td>
                                                        <td>
                                                            <b>{{ $cart_item->name }}</b> <br/>
                                                            
                                                        </td>
                                                        <td>{{ $cart_item->quantity }}</td>
                                                        <td>{{ $cart_item->price }}</td>
                                                        <td class="text-end">{{ $cart_item->price * $cart_item->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-5">
                                        <h6 class="text-muted">Notes:</h6>

                                        <small class="text-muted">
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end">
                                        <p><b>Sub-total:</b> <span class="float-end">{{ Cart::session(auth()->user()->id)->getSubTotal() }}</span></p>
                                        <p><b>Vat (5%):</b> <span class="float-end"> &nbsp;&nbsp;&nbsp; {{ $vatcondition->getCalculatedValue(Cart::session(auth()->user()->id)->getSubTotal()) }}</span></p>
                                        @php 
                                            Cart::session(auth()->user()->id)->condition($vatcondition);
                                            $total = Cart::session(auth()->user()->id)->getTotal();
                                        @endphp
                                        <h3 class="text-end">{{ $total }}</h3>
                                        @php 
                                            Cart::session(auth()->user()->id)->clearCartConditions();
                                        @endphp
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="mt-4 mb-1">
                                <div class="text-end d-print-none">
                                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer me-1"></i> Print</a>
                                    <button href="#" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#invoice_modal">Create Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row --> 
            
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Standard modal content -->
    <div id="invoice_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <div class="auth-logo">
                            <h3>Invoice Of {{ $customer->name }}</h3>
                            <h3>Total Amount {{ $total }}</h3>
                        </div>
                    </div>
                    <form class="mt-4" method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <input type="hidden" name="order_date" value="{{ date("d-F-Y") }}">
                        <input type="hidden" name="order_status" value="pending">
                        <input type="hidden" name="total_products" value="{{ Cart::session(auth()->user()->id)->getTotalQuantity() }}">
                        <input type="hidden" name="sub_total" value="{{ Cart::session(auth()->user()->id)->getSubTotal() }}">
                        <input type="hidden" name="vat" value="{{ $vatcondition->getCalculatedValue(Cart::session(auth()->user()->id)->getSubTotal()) }}">
                        <input type="hidden" name="total" value="{{ $total }}">


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment</label>
                                <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                                    <option value="HandCash">Hand Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Due">Due</option>

                                </select>
                                @error('payment_status ')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="pay" class="form-label">Pay Now</label>
                                <input type="text" class="form-control" name="pay">
                                @error('pay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                       <div class="col-md-12">
                            <div class="mb-3">
                                <label for="due" class="form-label">Due Amount</label>
                                <input type="text" class="form-control" name="due">
                                @error('due')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Complete Order</button>
                        </div>
                    </form>
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
  
@endsection