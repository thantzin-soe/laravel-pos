<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $supplierRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, SupplierRepositoryInterface $supplierRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->supplierRepository = $supplierRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->productRepository->getDataTable();
        }

        return view('backend.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $suppliers = $this->supplierRepository->getAll();

        return view('backend.product.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'product_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->productRepository->create($data);

        $notification = [
            'message' => 'New product created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = $this->categoryRepository->getAll();
        $suppliers = $this->supplierRepository->getAll();

        return view('backend.product.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            if ($product->image) {
                Storage::disk('cloudinary')->delete($product->image);
            }
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'product_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->productRepository->update($product->id, $data);

        $notification = [
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productRepository->delete($id);

        $notification = [
            'message' => 'Product deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }
}
