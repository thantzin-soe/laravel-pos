<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use Image;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->middleware('permission:customer.all', ['only' => ['index']]);
        $this->middleware('permission:customer.add', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->customerRepository->getDataTable();
        }

        return view('backend.customer.index');
    }

    public function search(Request $request)
    {
        $data = $this->customerRepository->findByName($request->q);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'customer_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->customerRepository->create($data);

        $notification = [
            'message' => 'New customer created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.index')->with($notification);
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
    public function edit(Customer $customer)
    {
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            if ($customer->image) {
                Storage::disk('cloudinary')->delete($customer->image);
            }
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'customer_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->customerRepository->update($customer->id, $data);

        $notification = [
            'message' => 'Customer updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->customerRepository->delete($id);

        $notification = [
            'message' => 'Customer deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.index')->with($notification);
    }
}
