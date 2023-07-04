<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Log;
use DataTables;
use App\Models\Product;
use Cart;
use Darryldecode\Cart\CartCondition;

class PosController extends Controller
{
    private $productRepository;
    private $customerRepository;
    private $vatcondition;

    public function __construct(ProductRepositoryInterface $productRepository, CustomerRepositoryInterface $customerRepository)
    {
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;

        $this->vatcondition = new CartCondition([
            'name' => 'VAT 5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '5%',
        ]);
    }

    public function pos(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Product::orderBy('name', 'ASC'))
                ->addIndexColumn()
                ->addColumn('action', function (Product $product) {
                    return view('backend.pos.product.datatable.action')->with('product', $product);
                })
                ->editColumn('image', function (Product $product) {
                    return "<img src='".$product->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        $cart_items = $cart_items = Cart::session(auth()->user()->id)->getContent();
        $cart_items = $cart_items->sortBy(function ($item, $key) {
            return $item['attributes']['created_at'];
        });
        return view('backend.pos.pos_page', compact('cart_items'))->with(['vatcondition' => $this->vatcondition]);
    }


    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findById($request->id);
        Cart::session(auth()->user()->id)->add([
            'id' => $product->id, // inique row ID
            'name' => $product->name,
            'price' => $product->selling_price,
            'quantity' => $request->quantity,
            'attributes' => ['created_at' => now()],
            'associatedModel' => $product
        ]);

        $notification = [
            'message' => 'Added to cart successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pos')->with($notification);
    }

    public function getFromCart()
    {
        dd(Cart::session(auth()->user()->id)->getConditions());
        dd(Cart::session(auth()->user()->id)->getCondition("VAT 5%")->parsedRawValue);
        Cart::clearCartConditions();
        Cart::session(auth()->user()->id)->clearCartConditions();
        Cart::session(auth()->user()->id)->clear();
        Cart::clear();
    }

    public function updateCart(Request $request)
    {
        Cart::session(auth()->user()->id)->update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ]
        ]);

        $notification = [
            'message' => 'Cart updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pos')->with($notification);
    }

    public function cartRemove(Request $request)
    {
        Cart::session(auth()->user()->id)->remove($request->id);

        $notification = [
            'message' => 'Item removed successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pos')->with($notification);
    }


    public function createInvoice(Request $request)
    {
        $request->validate([
            'customer_id' => ['required','integer', 'exists:customers,id']
        ], [
            'customer_id.required' => 'Please select customer'
        ]);

        $cart_items = Cart::session(auth()->user()->id)->getContent();
        $customer = $this->customerRepository->findById($request->customer_id);
        return view('backend.invoice.product_invoice', compact('cart_items', 'customer'))->with('vatcondition', $this->vatcondition);
    }
}
