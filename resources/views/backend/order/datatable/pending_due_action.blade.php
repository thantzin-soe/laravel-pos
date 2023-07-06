<a href="{{ route('orders.details', $order->id) }}" class="btn btn-info rounded-pill waves-effect waves-light"><i class="fa-solid fa-eye"></i></a>

<button href="#" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#invoice_modal" id="{{ $order->id }}" onclick="orderDue(this.id)">Pay Due</button>