<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Http\Requests\Supplier\SupplierStoreRequest;
use App\Http\Requests\Supplier\SupplierUpdateRequest;
use Image;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    private $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->supplierRepository->getDataTable();
        }

        return view('backend.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierStoreRequest $request)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'supplier_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->supplierRepository->create($data);

        $notification = [
            'message' => 'New supplier created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('suppliers.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('backend.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('backend.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            if ($supplier->image) {
                Storage::disk('cloudinary')->delete($supplier->image);
            }
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'supplier_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->supplierRepository->update($supplier->id, $data);

        $notification = [
            'message' => 'Supplier updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('suppliers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->supplierRepository->delete($id);

        $notification = [
            'message' => 'Supplier deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('suppliers.index')->with($notification);
    }
}
