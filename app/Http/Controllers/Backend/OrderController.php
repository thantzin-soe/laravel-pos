<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use Cart;
use DataTables;
use Darryldecode\Cart\CartCondition;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $vatcondition = new CartCondition([
            'name' => 'VAT 5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '5%',
        ]);
        Cart::session(auth()->user()->id)->condition($vatcondition);

        $data = [];
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['invoice_no'] = "EPOS".mt_rand(1000000, 9999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;

        $order = Order::create($data);
        $cart_items = Cart::session(auth()->user()->id)->getContent();
        foreach ($cart_items as $cart_item) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $cart_item->id,
                'quantity' => $cart_item->quantity,
                'unit_cost' => $cart_item->price,
                'total' => $cart_item->getPriceSum() + $vatcondition->getCalculatedValue($cart_item->getPriceSum())
            ]);
        }

        $notification = [
            'message' => 'Order completed successfully',
            'alert-type' => 'success'
        ];

        Cart::session(auth()->user()->id)->clear();
        Cart::session(auth()->user()->id)->clearCartConditions();

        return redirect()->route('pos')->with($notification);
    }

    public function pendingOrders(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Order::where('order_status', 'pending')->orderBy('id', 'DESC')->with(['customer']))
                ->addIndexColumn()
                ->addColumn('action', function (Order $order) {
                    return view('backend.order.datatable.action')->with('order', $order);
                })
                ->editColumn('image', function (Order $order) {
                    return "<img src='".$order->customer->image_url."' style='width:50px;height:40px'>";
                })
                ->editColumn('order_status', function (Order $order) {
                    return "<div class='badge bg-warning'>pending</div>";
                })
                ->rawColumns(['action', 'image', 'order_status'])
                ->make(true);
        }
        return view('backend.order.pending');
    }

    public function show(Order $order)
    {
        $order_items = OrderDetails::with('product')->where('order_id', $order->id)->orderBy('id', 'DESC')->get();

        return view('backend.order.details', compact('order', 'order_items'));
    }

    public function update(Order $order)
    {
        $order->update([
            'order_status' => 'complete'
        ]);

        $notification = [
            'message' => 'Order completed successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('orders.pending')->with($notification);
    }


    public function completedOrders(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Order::where('order_status', 'complete')->orderBy('id', 'DESC')->with(['customer']))
                ->addIndexColumn()
                ->addColumn('action', function (Order $order) {
                    return view('backend.order.datatable.completed_action')->with('order', $order);
                })
                ->editColumn('image', function (Order $order) {
                    return "<img src='".$order->customer->image_url."' style='width:50px;height:40px'>";
                })
                ->editColumn('order_status', function (Order $order) {
                    return "<div class='badge bg-success'>complete</div>";
                })
                ->rawColumns(['action', 'image', 'order_status'])
                ->make(true);
        }
        return view('backend.order.complete');
    }
}