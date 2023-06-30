<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use DataTables;
use App\Models\Product;

class PosController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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

        return view('backend.pos.pos_page');
    }
}
